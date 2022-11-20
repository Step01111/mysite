let formDelete = document.getElementById('form_delete');

SendDelete = function()
{   
    let request = {
        id: formCategory.category_id.value,
    };

    SendForm('/api/categories/delete', request)
    .then(function(responseOb) {
        console.log(responseOb);
        if (responseOb.ok) {
            location = '/adminpanel';
        } else {
            alert(responseOb.error);
        }
    });
}

formCategory.delete.onclick = function()
{
    formDelete.style.display = 'block';
}

formDelete.nodelete.onclick = function()
{
    formDelete.style.display = 'none';
}

formDelete.delete.onclick = SendDelete;