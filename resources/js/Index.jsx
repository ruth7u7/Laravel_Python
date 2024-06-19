import React from "react";
import { createRoot } from "react-dom/client";

const Index = () => {
    return(
        <div>A</div>
    )
}

export default Index
if (document.getElementById("application")){
    createRoot(document.getElementById("application")).render(<Index/>)
}