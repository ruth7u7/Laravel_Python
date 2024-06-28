import requests
from flask import Flask, request, jsonify
from flask_cors import CORS
import re

# Crear una instancia de la aplicación Flask
app = Flask(__name__)
# Habilitar CORS para todas las rutas
CORS(app)

# Definir una ruta para manejar las solicitudes POST en /chatbot
@app.route('/chatbot', methods=['POST'])
def chatbot():
    """
    Esta función maneja las solicitudes POST a la ruta /chatbot.
    Extrae el mensaje del cuerpo de la solicitud, lo procesa y devuelve una respuesta JSON.
    """
    data = request.get_json()  # Obtener datos JSON de la solicitud
    message = data.get('message')  # Extraer el mensaje del JSON
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
    api_url = f'http://localhost:8000/api/get/{idpelicula}'  # Construir la URL de la API
    response = requests.get(api_url)  # Hacer la solicitud GET a la API

    if response.status_code == 200:
        return response.json()  # Devolver la respuesta JSON si el estado es 200 OK
    else:
        return response.json("no se encontro la pelicula")  # Devolver un mensaje de error si no se encuentra la película
    
def format_movie_info(pelicula):
    """
    Esta función formatea la información de la película en una cadena legible.

    Args:
        pelicula (dict): La información de la película.

    Returns:
        str: La información de la película formateada como una cadena.
    """
    return f"""
    Titulo: {pelicula['Titulo']}
    FechaEstreno: {pelicula['FechaEstreno']}
    Director: {pelicula['Director']}
    Generos: {pelicula['Generos']}
    idClasificacion: {pelicula['idClasificacion']}
    idEstado: {pelicula['idEstado']}
    Duracion: {pelicula['Duracion']}
    Link: {pelicula['Link']}
    Reparto: {pelicula['Reparto']}
    Sinopsis: {pelicula['Sinopsis']}
    """.strip()

# Ejecutar la aplicación Flask en modo depuración
if __name__ == '__main__':
    app.run(debug=True)
