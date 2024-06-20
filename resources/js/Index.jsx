import React, {useState} from "react";
import axios from "axios";
import { createRoot } from "react-dom/client";
import Entry from "laravel-mix/src/builder/Entry";

const Index = () => {

    const [message, setMessage] = useState("");
    const [chatHistory, setchatHistory] = useState([]);

    const sendMessage = async () => {
        try {
            const response = await axios.post('/api/chatbot', {message})
            
            const {response: botResponse} = response.data;
                setchatHistory([...chatHistory, {user: message, bot: botResponse}]);
                setMessage('');   
            } catch(error){
                console.error("Error", error);
        }
    };

    const handleKEyPress = (event) => {
        if(event.key === 'Enter'){
            sendMessage();
        }
    };

    return (
        <div className="container">
            <h1>Hola</h1>
                <div className="border rounded p-3">
                    {chatHistory.map((entry, index) => (
                        <div key={index}><strong>Tú</strong>{msg.text}</div>))}
                </div>
                <div>
                    <input 
                        type="text"
                        className="form-control"
                        placeholder="Escribele al Botsito"
                        value={message}
                        onChange={(e) => setMessage(e.target.value)}
                    />
                    
                </div>
        </div>
    )
}
