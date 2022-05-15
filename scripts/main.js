

//vu qu'on utilise un gabarit obliger de faire ca pour avoir plusieurs css et js *-*


//CSS

let head = document.getElementsByTagName('HEAD')[0];

let title = document.title
console.log("titre" + title)

let cssFile = document.createElement('link');
cssFile.rel = 'stylesheet';
cssFile.type = 'text/css';

if (title == "1") {
    cssFile.href = 'css/style.css';
}
if (title == "Login") {
    cssFile.href = 'css/styleLogin.css';
}
head.appendChild(cssFile);



//JS 

let jsFile = document.createElement("script");

if (title == "ResponsableCRUD") {
    jsFile.setAttribute("src", "scripts/scriptResponsableCRUD.js");
}
if (title == "Login") {
    jsFile.setAttribute("src", "scripts/scriptLogin.js");
    
}

document.body.appendChild(jsFile);







