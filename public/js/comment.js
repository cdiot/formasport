/**
 * Récupére les messages au format JSON et les retournes dans la vue au format HTML
 */
function getMessages(){
    // Requête AJAX pour se connecter au serveur
    const AjaxRequest = new XMLHttpRequest();
    AjaxRequest.open("GET", "index.php?controller=commentcontrollers&task=get", true); 

    // Traitement des données 
        AjaxRequest.onload = function(){
          if (AjaxRequest.readyState === 4 && AjaxRequest.status === 200) {
          const resultat = JSON.parse(AjaxRequest.responseText);
          const html = resultat.reverse().map(function(message){
            return `
            <div class="message"> 
              <span class="messages_created_at">${message.messages_created_at}</span>
              <span class="instructor_firstname">${message.instructor_firstname}</span> : 
              <span class="messages_content">${message.messages_content}</span>
            </div>
            `
          }).join('');
          
          const messages = document.querySelector('.messages');
          
          messages.innerHTML = html;
          messages.scrollTop = messages.scrollHeight;
        
      } else {
        alert('contact avec le serveur impossible!')
      } 
      }
    // Envoie la requête
    AjaxRequest.send();
  }
  
  /**
   * Envoye le nouveau message au serveur et rafraichir les messages
   */
  function postMessage(event){
    // Stop l'action du formulaire
    event.preventDefault();
  
    
    // Récupére les données du formulaire
    const content = document.querySelector('#content');

    if (!content.value){
       alert('Le message à mal été rempli!');
    }
  
    // Conditionne les données
    const data = new FormData();
    data.append('content', content.value);

  
    // Configure une requête ajax en POST et envoyer les données
    const AjaxRequest = new XMLHttpRequest();
    AjaxRequest.open('POST', 'index.php?controller=commentcontrollers&task=post');
    
    AjaxRequest.onload = function(){
      content.value = '';
      content.focus();
      getMessages();
    }
  
    AjaxRequest.send(data);
  }
  
  document.querySelector('form').addEventListener('submit', postMessage);
  
  /**
   * Intervale rafraichissant les messages toutes les 3 secondes
   */
  const interval = window.setInterval(getMessages, 3000);
  
  getMessages();