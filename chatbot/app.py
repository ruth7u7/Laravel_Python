import requests
from flask import Flask, request, jsonify
from flask_cors import CORS
from flasgger import Swagger, swag_from
import re

# Crear una instancia de la aplicación Flask
app = Flask(__name__)

# Habilitar CORS para todas las rutas
CORS(app)

# Inicializar Swagger 
swagger = Swagger(app)

# Definir una ruta para manejar las solicitudes POST en /chatbot
@app.route('/chatbot', methods=['POST'])
@swag_from({
    'summary': 'Procesa el mensaje del usuario y devuelve una respuesta del chatbot.',
    'description': 'Cuando el usuario escriba el ID de una película, el chatbot devolverá la información de la película desde una API externa.',
    'responses': {
        200: {
            'description': 'Respuesta exitosa',
            'schema': {
                'type': 'object',
                'properties': {
                    'Response': {
                        'type': 'string',
                        'description': 'La respuesta del chatbot'
                    }
                }
            }
        },
        400: {
            'description': 'Solicitud incorrecta',
            'schema': {
                'type': 'object',
                'properties': {
                    'error': {
                        'type': 'string',
                        'description': 'Descripción del error'
                    }
                }
            }
        }
    },
    'parameters': [
        {
            'name': 'body',
            'in': 'body',
            'required': True,
            'schema': {
                'type': 'object',
                'properties': {
                    'message': {
                        'type': 'string',
                        'example': 'pelicula 1'
                    }
                }
            }
        }
    ]
})
def chatbot():
    """
    Esta función maneja las solicitudes POST a la ruta /chatbot.
    Extrae el mensaje del cuerpo de la solicitud, lo procesa y devuelve una respuesta JSON.
    """
    data = request.get_json()  # Obtener datos JSON de la solicitud
    if not data or 'message' not in data:
        return jsonify({"error": "Mensaje no proporcionado"}), 400
    message = data['message']  # Extraer el mensaje del JSON
    response_message = handle_message(message)  # Procesar el mensaje
    return jsonify({"Response": response_message})  # Devolver la respuesta como JSON

def handle_message(message):
    """
    Esta función maneja el mensaje recibido del usuario.
    Verifica si el mensaje contiene una referencia a una película por su ID,
    y si es así, obtiene la información de la película de una API externa.

    Args:
        message (str): El mensaje del usuario.

    Returns:
        str: La respuesta del chatbot.
    """
    # Buscar un patrón que coincida con "pelicula" seguido de un número o un número solo
    match = re.search(r'pelicula\s*(\d+)|^(\d+)$', message, re.IGNORECASE)
    if match:
        id_pelicula = match.group(1) or match.group(2)  # Obtener el ID de la película
        pelicula_info = get_movie_from_php_api(int(id_pelicula))  # Obtener información de la película
        
        if pelicula_info:
            return format_movie_info(pelicula_info)  # Formatear y devolver la información de la película
        else:
            return f"Lo siento, no encontré ninguna película con el ID {id_pelicula}."
    else:
        return "Por favor, proporciona el ID de una película. Por ejemplo, escribe 'película 1' o simplemente '1'."

def get_movie_from_php_api(idpelicula):
    """
    Esta función hace una solicitud GET a una API externa para obtener información de una película
    basada en su ID.

    Args:
        idpelicula (int): El ID de la película.

    Returns:
        dict: La información de la película en formato JSON si se encuentra, None en caso contrario.    
    """
    api_url = f'http://localhost:8000/api/get/{idpelicula}'  # Consumir la URL de la API de Laravel
    try:
        response = requests.get(api_url)  # Hacer la solicitud GET a la API
        response.raise_for_status()  # Lanza una excepción para códigos de estado HTTP erróneos
        return response.json()  # Devolver la respuesta JSON si el estado es 200 OK
    except requests.RequestException as e:
        print(f"Error al obtener la película: {e}")
        return None

def format_movie_info(pelicula):
    """
    Esta función formatea la información de la película en una cadena legible.

    Args:
        pelicula (dict): La información de la película.

    Returns:
        str: La información de la película formateada como una cadena.
    """
    return "\n".join([f"{key}: {value}" for key, value in pelicula.items()])

# Ejecutar la aplicación Flask en modo depuración
if __name__ == '__main__':
    app.run(debug=True)