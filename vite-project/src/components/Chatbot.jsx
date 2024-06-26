// import React, {useState, useEffect, useRef} from "react";
// import axios from "axios";

// const Chatbot = () => {

//     const [message, setMessage] = useState('');
//     const [chat, setChat] = useState([]);
//     const chatEndRef = useRef(null);

//     const sendMessage = async () => {
//         try {
//             console.log("Entrando")
//             const response = await axios.post('http://localhost:5000/chatbot', {message})
//             console.log(response)
//             setChat([...chat, {user: 'You', text:message}, {user: 'Chatbot', text: response.data.Response}]);
//             setMessage('');   
//             } catch(error){
//                 console.error("Error enviando el mensaje:", error);
//                 setChat([...chat, {user: 'You', text: message}, {user: 'Chatbot', text:'Ocurrió un error, intenta nuevamente'}])
//         }
//     };

//     useEffect(() => {
//         chatEndRef.current?.scrollIntoView({behavior: 'smooth'});
//     }, [chat]);

//     const handleKeyPress = (event) => {
//         if(event.key === 'Enter'){
//             sendMessage();
//         }
//     };

//     return (
//         <div className="container">
//             <h1>DIRCEBOT</h1>
//                 <div className="border rounded p-3">
//                     {chat.map((msg, index) => (
//                         <div key={index}><strong>{msg.user}</strong>{msg.text}</div>
//                         ))}
//                 </div>
//                 <div className="input-group mt-3">
//                     <input 
//                         type="text"
//                         className="form-control"
//                         placeholder="Escribele al Botsito"
//                         value={message}
//                         onChange={(e) => setMessage(e.target.value)}
//                         onKeyPress={handleKeyPress}
//                     />
//                     <div className="input-group-append">
//                         <button className="btn btn-primary" onClick={sendMessage} disabled={!message}>Enviar</button>
//                     </div>
//                 </div>
//         </div>
//     );
// };

// export default Chatbot;
import React, { useState, useEffect, useRef } from "react";
import axios from "axios";

const Chatbot = () => {
  const [message, setMessage] = useState('');
  const [chat, setChat] = useState([]);
  const chatEndRef = useRef(null);

  const sendMessage = async () => {
    if (!message.trim()) return;
    
    try {
      const response = await axios.post('http://localhost:5000/chatbot', { message });
      const botResponse = response.data.Response;
      
      let formattedResponse = botResponse;
      if (typeof botResponse === 'object' && botResponse !== null) {
        formattedResponse = formatMovieData(botResponse);
      }

      setChat([...chat, 
        { user: 'You', text: message }, 
        { user: 'Chatbot', text: formattedResponse }
      ]);
      setMessage('');
    } catch (error) {
      console.error("Error enviando el mensaje:", error);
      setChat([...chat, 
        { user: 'You', text: message }, 
        { user: 'Chatbot', text: 'Ocurrió un error, intenta nuevamente' }
      ]);
    }
  };

  const formatMovieData = (movieData) => {
    return Object.entries(movieData)
      .map(([key, value]) => `${key}: ${value}`)
      .join('\n');
  };

  useEffect(() => {
    chatEndRef.current?.scrollIntoView({ behavior: 'smooth' });
  }, [chat]);

  const handleKeyPress = (event) => {
    if (event.key === 'Enter') {
      sendMessage();
    }
  };

  return (
    <div className="container mt-5">
      <h1 className="text-center mb-4">DIRCEBOT</h1>
      <div className="border rounded p-3 mb-3" style={{height: '400px', overflowY: 'auto'}}>
        {chat.map((msg, index) => (
          <div key={index} className={`mb-2 ${msg.user === 'You' ? 'text-right' : 'text-left'}`}>
            <strong>{msg.user}: </strong>
            <pre style={{whiteSpace: 'pre-wrap', wordBreak: 'break-word', fontFamily: 'inherit'}}>
              {msg.text}
            </pre>
          </div>
        ))}
        <div ref={chatEndRef} />
      </div>
      <div className="input-group">
        <input 
          type="text"
          className="form-control"
          placeholder="Escríbele al Botsito (ej: pelicula 1)"
          value={message}
          onChange={(e) => setMessage(e.target.value)}
          onKeyPress={handleKeyPress}
        />
        <div className="input-group-append">
          <button className="btn btn-primary" onClick={sendMessage} disabled={!message.trim()}>
            Enviar
          </button>
        </div>
      </div>
    </div>
  );
};

export default Chatbot;
