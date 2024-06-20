from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
import requests

app = Flask(__name__)

API_URL = 'localhost:8000/api/show'

@app.route('/chatbot', methods = ['POST'])

def chatbot():
    data = request.get_json()
    message = data.get('message')

    response_message = handle_message(message)

    return jsonify({"Response": response_message})

def handle_message(mesage):
    if mesage.lower().startswith('pelicula'):
        parts = message.split()
        if len(parts) > 1:
            try:
                peli_id = int(parts[1])
                response = requests.get(f"{API_URL}/{peli_id}")
                if response.status.code == 200:
                    peli_data = response.json()
                    return f"Título: {peli_data['Título']}, Fecha de Estreno: {peli_data['FechaEstreno']}"
                else:
                    return "No se encontró la película"
            except ValueError:
                return "ID de película no valido"
        else:
            return "Proporciona un ID de una película"
    else:
        return "No entendí"

if __name__== '__main__':
    app.run(debug=True)