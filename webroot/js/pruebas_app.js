


async function newCompra()
{
    let id_cliente = 4;
    let users_idusers = 3;
    let subtotal = 5000;
    let descuentos = 1000;
    let total = 4000;
    let descuento_general = 0;
    let campaign_idcampaign = 2;


    let data = {
        id_cliente : id_cliente,
        users_idusers : users_idusers,
        subtotal : subtotal,
        descuentos : descuentos,
        total : total,
        descuento_general : descuento_general,
        campaign_idcampaign : campaign_idcampaign
    }



    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    // headers.append('X-CSRF-Token', csrf);



    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/addVenta', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    });
    const content = await rawResponse.json();

    console.log(content);
}

async function getCampaignUser()
{

    let users_idusers = 3;



    let data = {
        user_id : users_idusers,

    }



    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    // headers.append('X-CSRF-Token', csrf);



    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/getCampaignUser', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    });
    const content = await rawResponse.json();

    console.log(content);
}

async function getProductos()
{

    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    // headers.append('X-CSRF-Token', csrf);



    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/getProductos', {
        method: 'POST',
        headers: headers
    });
    const content = await rawResponse.json();

    console.log(content);
}

async function getCategories()
{

    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    // headers.append('X-CSRF-Token', csrf);



    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/getCategories', {
        method: 'POST',
        headers: headers
    });
    const content = await rawResponse.json();

    console.log(content);
}
(async () => {
    //getCategories();
})();



/*(async () => {


    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
   // headers.append('X-CSRF-Token', csrf);

    let data = {username : 'cris@hotmail.com', password: '123456'}

    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/loginApp', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    });
    const content = await rawResponse.json();

    console.log(content);
})();
*/

(async () => {


    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    // headers.append('X-CSRF-Token', csrf);

    let data = {idusers : 3}

    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/getCompras', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    });
    const content = await rawResponse.json();

    console.log(content);
})();

/*
(async () => {


    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    // headers.append('X-CSRF-Token', csrf);

    let data = {idusers : 3, idcomprasstock : 15, idproductos : 45, cantidad : 10}

    const rawResponse = await fetch('http://localhost/stockcontrolv3/API/setCompras', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    });
    const content = await rawResponse.json();

    console.log(content);
})();*/