# from flask import Flask, request, jsonify
# from flask_cors import CORS
# from flask_sqlalchemy import SQLAlchemy
# import requests

# app = Flask(__name__)
# CORS(app)
# app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:@localhost/cinestar'
# db = SQLAlchemy(app)

# API_URL = 'http://localhost:8000/api/get/{idpelicula}'

# @app.route('/chatbot', methods = ['POST'])

# def chatbot():
#     data = request.get_json()
#     message = data.get('message')

#     response_message = handle_message(message)

#     return jsonify({"Response": response_message})

# def handle_message(message):
#     if message.lower().startswith('pelicula'):
#         parts = message.split()
#         if len(parts) > 1:
#             try:
#                 peli_id = int(parts[1])
#                 url = API_URL.format(idpelicula = peli_id)
#                 response = requests.get(url)
#                 # response = requests.get(f"{API_URL}/{peli_id}")
#                 if response.status_code == 200:
#                     peli_data = response.json()
#                     return f"Título: {peli_data['Título']}, Fecha de Estreno: {peli_data['FechaEstreno']}"
#                 else:
#                     return "No se encontró la película"
#             except ValueError:
#                 return "ID de película no valido"
#         else:
#             return "Proporciona un ID de una película"
#     else:
#         return "No entendí"

# @app.route('/api/get/<int:idpelicula>', methods=['GET'])
# def get_pelicula(idpelicula):
#     # Aquí deberías implementar la lógica para obtener la información de la película
#     # Por ahora, simplemente devolveremos un mensaje de ejemplo
#     return jsonify({"Título": f"Película {idpelicula}", "FechaEstreno": "2023-01-01"})

# if __name__== '__main__':
#     app.run(debug=True)

from flask import Flask, request, jsonify
from flask_cors import CORS
from flask_sqlalchemy import SQLAlchemy
import re
# import mysql.connector 
# import requests

app = Flask(__name__)
CORS(app)
#app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:@localhost/cinestar'
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:@localhost/cinestar'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

class Pelicula(db.Model):
    __tablename__ = 'pelicula'
    id = db.Column(db.Integer, primary_key=True)
    Titulo = db.Column(db.String(100), nullable=False)
    FechaEstreno = db.Column(db.Date, nullable=False)
    Director = db.Column(db.String(100))
    Generos = db.Column(db.String(100))
    idClasificacion = db.Column(db.Integer)
    idEstado = db.Column(db.Integer)
    Duracion = db.Column(db.Integer)
    Link = db.Column(db.String(100))

    def to_dict(self):
        return {
            'id': self.id,
            'Titulo': self.Titulo,
            'FechaEstreno': self.FechaEstreno.strftime('%Y-%m-%d'),
            'Director': self.Director,
            'Generos': self.Generos,
            'idClasificacion': self.idClasificacion,
            'idEstado': self.idEstado,
            'Duracion': self.Duracion,
            'Link': self.Link
        }

@app.route('/chatbot', methods=['POST'])
def chatbot():
    data = request.get_json()
    message = data.get('message')
    response_message = handle_message(message)
    return jsonify({"Response": response_message})

def handle_message(message):
    if message.lower().startswith('pelicula'):
        parts = message.split()
        if len(parts) > 1:
            try:
                peli_id = int(parts[1])
                peli_data = get_pelicula(peli_id)
                if peli_data:
                    return f"Información de la película:\n{peli_data}"
                else:
                    return "No se encontró la película"
            except ValueError:
                return "ID de película no válido"
        else:
            return "Proporciona un ID de una película"
    else:
        return "No entendí. Para buscar una película, escribe 'pelicula' seguido del ID."

@app.route('/api/get/<int:idpelicula>', methods=['GET'])
def get_pelicula(idpelicula):
    pelicula = Pelicula.query.get(idpelicula)
    if pelicula:
        return jsonify(pelicula.to_dict())
    else:
        return jsonify({"error": "Película no encontrada"}), 404

if __name__ == '__main__':
    app.run(debug=True)