// resources/js/app.js
import React, {useState} from 'react';
import '../../resources/js/Index';
import ReactDOM from 'react-dom';

function App() {
    return (
        <div>
            <h1>Hello, React with Laravel Mix!</h1>
        </div>
    );
}

ReactDOM.render(<App />, document.getElementById('root'));
