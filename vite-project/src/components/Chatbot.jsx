import React, { useState, useEffect, useRef } from "react";
import axios from "axios";
import { X } from 'lucide-react'; // Icono para el botón de cerrar
import './Chatbot.css';  // Asegúrate de importar el archivo CSS

const Chatbot = () => {
  // Estados para controlar la visibilidad del modal, el mensaje del usuario y el historial de chat
  const [isOpen, setIsOpen] = useState(false);
  const [message, setMessage] = useState('');
  const [chat, setChat] = useState([]);
  
  // Referencia al final del chat para scroll automático
  const chatEndRef = useRef(null);

  // Efecto para hacer scroll automático al final del chat cada vez que se actualiza
  useEffect(() => {
    chatEndRef.current?.scrollIntoView({ behavior: 'smooth' });
  }, [chat]);

  // Función para enviar un mensaje al chatbot
  const sendMessage = async () => {
    if (!message.trim()) return; // No enviar mensajes vacíos
    try {
      console.log("iniciando");
      const response = await axios.post('http://localhost:5000/chatbot', { message });
      const botResponse = response.data.Response;
      console.log(response);
      let formattedResponse = botResponse;

      // Formatear la respuesta si es un objeto (por ejemplo, datos de una película)
      if (typeof botResponse === 'object' && botResponse !== null) {
        formattedResponse = formatMovieData(botResponse);
      }

      // Actualizar el historial de chat
      setChat([...chat,
        { user: 'You', text: message },
        { user: 'Chatbot', text: formattedResponse }
      ]);
      setMessage(''); // Limpiar el campo de entrada
    } catch (error) {
      console.error("Error enviando el mensaje:", error);
      // Mostrar un mensaje de error en el chat
      setChat([...chat,
        { user: 'You', text: message },
        { user: 'Chatbot', text: 'Ocurrió un error, intenta nuevamente' }
      ]);
    }
  };

  // Función para formatear los datos de una película
  const formatMovieData = (movieData) => {
    return Object.entries(movieData)
      .map(([key, value]) => `${key}: ${value}`)
      .join('\n');
  };

  // Función para manejar la tecla Enter en el campo de entrada
  const handleKeyPress = (event) => {
    if (event.key === 'Enter') {
      sendMessage();
    }
  };

  return (
    <div className="chatbot-container">
      {!isOpen ? (
        <button
          onClick={() => setIsOpen(true)}
          className="chat-button"
        >
          Chat
        </button>
      ) : (
        <div className="chat-modal">
          <div className="chat-header">
            <h2 className="chat-title">BOT</h2>
            <button onClick={() => setIsOpen(false)} className="close-button">
              <X size={24} />
            </button>
          </div>
          <div className="chat-messages">
            {chat.map((msg, index) => (
              <div key={index} className={`message ${msg.user === 'You' ? 'message-you' : 'message-bot'}`}>
                <div className="message-content">
                  <strong>{msg.user}: </strong>
                  {msg.text}
                </div>
              </div>
            ))}
            <div ref={chatEndRef} />
          </div>
          <div className="chat-input">
            <div className="input-group">
              <input
                type="text"
                className="chat-input-field"
                placeholder="Escríbele al Botsito (ej: pelicula 1)"
                value={message}
                onChange={(e) => setMessage(e.target.value)}
                onKeyPress={handleKeyPress}
              />
              <button
                className="send-button"
                onClick={sendMessage}
                disabled={!message.trim()}
              >
                Enviar
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Chatbot;
