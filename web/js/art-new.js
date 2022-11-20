let formNewArt = document.getElementById('new_art');

SendNewArt = function()
{
    let name = formNewArt.artname.value;
    let category = formNewArt.category.value;

    if (!name) {
        alert('Укажите название статьи');
        return;
    }
    
    let alias = NameTranslit(name);
    
    let request = {
        name: name,
        category: category,
        alias: alias,
    };

    SendForm('/api/art/create', request)
    .then(function(responseOb) {
        if (responseOb.ok) {
            location = '/art/' + responseOb.artId + '/edit';
        } else {
            alert(responseOb.error);
        }
    });
}

formNewArt.send.onclick = SendNewArt;