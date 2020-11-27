var Consoles_newsBtn = document.getElementById('consoles_news-button');
var Consoles_newsContainer = document.getElementById('consoles_news-container');


if (Consoles_newsBtn){
    Consoles_newsBtn.addEventListener('click', function (){
        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', 'https://wpp.lndo.site/wp-json/wp/v2/posts');
        ourRequest.onload = function() {
            if (ourRequest.status >= 200 && ourRequest.status < 400) {
                var data = JSON.parse(ourRequest.responseText);
                createHTML(data);
                Consoles_newsBtn.remove();
            } else {
                console.log("We connected to the server, but it returned an error.");
            }
        };

        ourRequest.onerror = function() {
            console.log("Connection error");
        };

        ourRequest.send();
    });
}

function createHTML(postsData){
    var ourHTMLString = '';
    for (i = 0; i < postsData.length; i++){
        ourHTMLString += '<h2>'+ postsData[i].title.rendered + '</h2>';
        ourHTMLString+= postsData[i].content.rendered;
    }
    Consoles_newsContainer.innerHTML = ourHTMLString;
}
