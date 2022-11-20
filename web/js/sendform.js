function SendForm (url, request)
{
    if (request) {
        request = JSON.stringify(request);
    }

    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: request
    })
    .then(function (response) {
        return response.json();
    })
}