let formArt = document.getElementById('form_art');

SendArt = function()
{
    let name = formNewArt.artname.value;
    let category = formNewArt.category.value;

    if (!name) {
        alert('Укажите название статьи');
        return;
        }
    
    let request = {
        name: name,
        category: category,
    };

    request = JSON.stringify(request);

    let promise = fetch('/api/art/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: request
    });

    promise.then(function (response) {
        return response.json();
    })
    .then(function(responseOb) {
        console.log(responseOb);
        if (responseOb.ok) {
            location = '/art/' + responseOb.artId + '/edit';
        } else {
            alert(responseOb.error);
        }
    });
}

formArt.send.onclick = SendArt;

formArt.onkeydown = function (event) {
    if (event.keyCode == 13) {
        SendArt();
    }
}