import React, {useState, useEffect, useRef} from "react";
import axios from "axios";

const Index = () => {

    const [message, setMessage] = useState('');
    const [chat, setChat] = useState([]);
    const chatEndRef = useRef(null);

    const sendMessage = async () => {
        try {
            const response = await axios.post('http:localhost:8000/api/chatbot', {message})
            setChat([...chat, {user: 'You', text:message}, {user: 'Chatbot', text: response.data.response}]);
            setMessage('');   
            } catch(error){
                console.error("Error enviando el mensaje:", error);
                setChat([...chat, {user: 'You', text: message}, {user: 'Chatbot', text:'Ocurrió un error, intenta nuevamente'}])
        }
    };

    useEffect(() => {
        chatEndRef.current?.scrollIntoView({behavior: 'smooth'});
    }, [chat]);

    // const handleKEyPress = (event) => {
    //     if(event.key === 'Enter'){
    //         sendMessage();
    //     }
    // };

    return (
        <div className="container">
            <h1>DIRCEBOT</h1>
                <div className="border rounded p-3">
                    {chat.map((msg, index) => (
                        <div key={index}><strong>{msg.user}</strong>{msg.text}</div>
                        ))}
                </div>
                <div className="input-group mt-3">
                    <input 
                        type="text"
                        className="form-control"
                        placeholder="Escribele al Botsito"
                        value={message}
                        onChange={(e) => setMessage(e.target.value)}
                    />
                    <div className="input-group-append">
                        <button className="btn btn-primary" onClick={sendMessage} disabled={!message}>Enviar</button>
                    </div>
                </div>
        </div>
    );
};

export default Index;
