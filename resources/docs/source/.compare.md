---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Administration management


APIs for managing Administration
<!-- START_f45f3e14bf7aeace9e260a6de5587ef4 -->
## Display a listing of Administrations.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/administrations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/administrations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "ministere@sante.dz",
            "name": "ministère de la santé de",
            "description": null,
            "wilaya_id": 16
        }
    ]
}
```

### HTTP Request
`GET api/administrations`


<!-- END_f45f3e14bf7aeace9e260a6de5587ef4 -->

<!-- START_aba934e97e36c8602f65ef86d9db6bdc -->
## Store a newly created Administration in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/administrations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"admin@sante.dz","name":"admin","wilaya_id":16,"password":"98776","description":".......................","address":"Alger"}'

```

```javascript
const url = new URL(
    "http://localhost/api/administrations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "admin@sante.dz",
    "name": "admin",
    "wilaya_id": 16,
    "password": "98776",
    "description": ".......................",
    "address": "Alger"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "ministere@sante.dz",
        "name": "ministere",
        "description": null,
        "wilaya_id": 19
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The id has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/administrations`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | string |  required  | The id .
        `name` | string |  required  | The firt name of the administration.
        `wilaya_id` | integer |  required  | The wilaya of the administration.
        `password` | string |  required  | The password.
        `description` | string |  optional  | a description of the administration.
        `address` | date |  optional  | address of the administration.
    
<!-- END_aba934e97e36c8602f65ef86d9db6bdc -->

<!-- START_786d8e6445d366722ff7983880f69a5b -->
## Display the specified Administration.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/administrations/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/administrations/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "ministere@sante.dz",
        "name": "ministere",
        "description": null,
        "wilaya_id": 19
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "administration not found"
}
```

### HTTP Request
`GET api/administrations/{administration}`


<!-- END_786d8e6445d366722ff7983880f69a5b -->

<!-- START_584482630661e269282f83243eab6077 -->
## Remove the specified Administration from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/administrations/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/administrations/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "administration deleted"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "administration not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Database server error"
}
```

### HTTP Request
`DELETE api/administrations/{administration}`


<!-- END_584482630661e269282f83243eab6077 -->

<!-- START_c23912956fc801b24d36d145a86979f8 -->
## Login Admin.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/login/administration" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/login/administration"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "ministere@sante.dz",
        "name": "ministere",
        "description": null,
        "wilaya_id": 19
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "administration not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Wrong pass word"
}
```

### HTTP Request
`POST api/login/administration`


<!-- END_c23912956fc801b24d36d145a86979f8 -->

#Diseases management


APIs for managing Diseases
<!-- START_4fd4cf5470b0085b5d5e98d21c320e93 -->
## Display a listing of the diseases.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/diseases" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/diseases"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "Covid_19",
            "description": "La maladie à coronavirus 2019 , ou le ou la Covid-19 (acronyme anglais de coronavirus disease 2019), est une maladie infectieuse émergente de type zoonose virale causée par la souche de coronavirus SARS-CoV-2."
        }
    ]
}
```

### HTTP Request
`GET api/diseases`


<!-- END_4fd4cf5470b0085b5d5e98d21c320e93 -->

<!-- START_855154e7dcf2e3758e55bb19ae2111a5 -->
## Store a newly created disease in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/diseases" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"Covid_19","description":"....."}'

```

```javascript
const url = new URL(
    "http://localhost/api/diseases"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "Covid_19",
    "description": "....."
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "Covid_19",
        "description": null
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The id has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/diseases`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | string |  required  | The id .
        `description` | string |  optional  | a description of the disease.
    
<!-- END_855154e7dcf2e3758e55bb19ae2111a5 -->

<!-- START_0f13dd56e2f422b434e2d80a20965498 -->
## Display the specified disease.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/diseases/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/diseases/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "Covid_19",
        "description": null
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "hospital not found"
}
```

### HTTP Request
`GET api/diseases/{disease}`


<!-- END_0f13dd56e2f422b434e2d80a20965498 -->

<!-- START_53c602d5d4d0c9fcecad3efe80c87a9c -->
## Remove the specified disease from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/diseases/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/diseases/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "disease deleted"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "disease not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Database server error"
}
```

### HTTP Request
`DELETE api/diseases/{disease}`


<!-- END_53c602d5d4d0c9fcecad3efe80c87a9c -->

#Hospital management


APIs for managing Hospital
<!-- START_8a075e4ecd8a0b915ef37c441067b457 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/hospitals" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/hospitals"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "pacha@sante.dz",
            "name": "mustapha pacha",
            "description": null,
            "places": 151,
            "lat": 36.762199,
            "lng": 3.053796,
            "wilaya_id": 16
        },
        {
            "id": "saadna@sante.dz",
            "name": "saadna abdenour",
            "description": null,
            "places": 150,
            "lat": 36.191404,
            "lng": 5.403133,
            "wilaya_id": 19
        }
    ]
}
```

### HTTP Request
`GET api/hospitals`


<!-- END_8a075e4ecd8a0b915ef37c441067b457 -->

<!-- START_0d4a62419cf95816fda538d56aad78f1 -->
## Store a newly created Hospital in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/hospitals" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"hospital@sante.dz","name":"hospital","wilaya_id":16,"password":"98776","description":".......................","address":"Alger","places":"151.171936"}'

```

```javascript
const url = new URL(
    "http://localhost/api/hospitals"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "hospital@sante.dz",
    "name": "hospital",
    "wilaya_id": 16,
    "password": "98776",
    "description": ".......................",
    "address": "Alger",
    "places": "151.171936"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pacha@sante.dz",
        "name": "mustapha pacha",
        "description": null,
        "places": 151,
        "lat": 36.762199,
        "lng": 3.053796,
        "wilaya_id": 16
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The id has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/hospitals`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | string |  required  | The id .
        `name` | string |  required  | The firt name of the Hospital.
        `wilaya_id` | integer |  required  | The wilaya of the Hospital.
        `password` | string |  required  | The password.
        `description` | string |  optional  | a description of the Hospital.
        `address` | date |  optional  | address of the Hospital.
        `places` | lng |  optional  | longitudes.
    
<!-- END_0d4a62419cf95816fda538d56aad78f1 -->

<!-- START_4ede2f67c568c7b6163108f4b170aceb -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/hospitals/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/hospitals/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pacha@sante.dz",
        "name": "mustapha pacha",
        "description": null,
        "places": 151,
        "lat": 36.762199,
        "lng": 3.053796,
        "wilaya_id": 16
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "hospital not found"
}
```

### HTTP Request
`GET api/hospitals/{hospital}`


<!-- END_4ede2f67c568c7b6163108f4b170aceb -->

<!-- START_4f0edf60fcef97f880282dec488ef4ed -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/hospitals/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/hospitals/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "hospital deleted"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "hospital not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Database server error"
}
```

### HTTP Request
`DELETE api/hospitals/{hospital}`


<!-- END_4f0edf60fcef97f880282dec488ef4ed -->

<!-- START_7a15ca89be58b1de5830dfe99b21ad74 -->
## Login hospital.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/login/hospital" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/login/hospital"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pacha@sante.dz",
        "name": "mustapha pacha",
        "description": null,
        "places": 151,
        "lat": 36.762199,
        "lng": 3.053796,
        "wilaya_id": 16
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "hospital not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Wrong pass word"
}
```

### HTTP Request
`POST api/login/hospital`


<!-- END_7a15ca89be58b1de5830dfe99b21ad74 -->

<!-- START_212e52ca8944cc0bdf79421810e8ed1f -->
## Get the best hospital.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/hospitals/besthospital" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"wilaya":19,"lat":-33.861034,"lng":151.171936}'

```

```javascript
const url = new URL(
    "http://localhost/api/hospitals/besthospital"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "wilaya": 19,
    "lat": -33.861034,
    "lng": 151.171936
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pacha@sante.dz",
        "name": "mustapha pacha",
        "description": null,
        "places": 151,
        "lat": 36.762199,
        "lng": 3.053796,
        "wilaya_id": 16
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "no hospital found,full"
}
```

### HTTP Request
`POST api/hospitals/besthospital`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `wilaya` | integer |  optional  | wilaya id.
        `lat` | float |  optional  | latitudes.
        `lng` | float |  optional  | longitudes.
    
<!-- END_212e52ca8944cc0bdf79421810e8ed1f -->

<!-- START_60da935406b83c51ec60bde40f1ec704 -->
## Get a place on the specified hospital.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/hospitals/allocate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":0}'

```

```javascript
const url = new URL(
    "http://localhost/api/hospitals/allocate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 0
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "no hospital found"
}
```
> Example response (501):

```json
{
    "status": "error",
    "message": "no modification"
}
```

### HTTP Request
`PUT api/hospitals/allocate`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  optional  | hospital_id.
    
<!-- END_60da935406b83c51ec60bde40f1ec704 -->

<!-- START_1fc1f4d19c74054717bad0f48213fbf0 -->
## free a place on the specified hospital.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/hospitals/free" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":0}'

```

```javascript
const url = new URL(
    "http://localhost/api/hospitals/free"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 0
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "no hospital found"
}
```
> Example response (501):

```json
{
    "status": "error",
    "message": "no modification"
}
```

### HTTP Request
`PUT api/hospitals/free`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  optional  | hospital_id.
    
<!-- END_1fc1f4d19c74054717bad0f48213fbf0 -->

<!-- START_c54923d404b504b97f2341feeadde8ca -->
## Set coordinates the specified hospital.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/hospitals/coordinates" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":0,"lat":-33.861034,"lng":151.171936}'

```

```javascript
const url = new URL(
    "http://localhost/api/hospitals/coordinates"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 0,
    "lat": -33.861034,
    "lng": 151.171936
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "no hospital found"
}
```
> Example response (501):

```json
{
    "status": "error",
    "message": "no modification"
}
```

### HTTP Request
`PUT api/hospitals/coordinates`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  optional  | hospital_id.
        `lat` | float |  optional  | latitudes.
        `lng` | float |  optional  | longitudes.
    
<!-- END_c54923d404b504b97f2341feeadde8ca -->

#Laboratories management


APIs for managing Laboratories
<!-- START_2a9df5c4e862c34e01aeb44a5d5b5212 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/laboratories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/laboratories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "pasteur@sante.dz",
            "name": "pasteur",
            "description": null,
            "wilaya_id": 16
        }
    ]
}
```

### HTTP Request
`GET api/laboratories`


<!-- END_2a9df5c4e862c34e01aeb44a5d5b5212 -->

<!-- START_0da628cac958381b30589587bc235845 -->
## Store a newly created Laboratory in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/laboratories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"labo@sante.dz","name":"labo","wilaya_id":16,"password":"98776","description":".......................","address":"quo"}'

```

```javascript
const url = new URL(
    "http://localhost/api/laboratories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "labo@sante.dz",
    "name": "labo",
    "wilaya_id": 16,
    "password": "98776",
    "description": ".......................",
    "address": "quo"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pascal@sante.dz",
        "name": "pascal",
        "description": null,
        "wilaya_id": 16
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The id has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/laboratories`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | string |  required  | The id .
        `name` | string |  required  | The firt name of the Laboratory.
        `wilaya_id` | integer |  required  | The wilaya of the Laboratory.
        `password` | string |  required  | The password.
        `description` | string |  optional  | a description of the Laboratory.
        `address` | date |  optional  | the address of the laboratory
    
<!-- END_0da628cac958381b30589587bc235845 -->

<!-- START_ab4561ae3ea9f7a93316a4f0bebc02f9 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/laboratories/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/laboratories/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pascal@sante.dz",
        "name": "pascal",
        "description": null,
        "wilaya_id": 16
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "laboratory not found"
}
```

### HTTP Request
`GET api/laboratories/{laboratory}`


<!-- END_ab4561ae3ea9f7a93316a4f0bebc02f9 -->

<!-- START_b84e2ea82e8e017d9e683dfd704c0095 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/laboratories/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/laboratories/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "laboratory deleted"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "laboratory not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Database server error"
}
```

### HTTP Request
`DELETE api/laboratories/{laboratory}`


<!-- END_b84e2ea82e8e017d9e683dfd704c0095 -->

<!-- START_e6e4034921b80408432429d41a17cfca -->
## Login Laboratory.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/login/laboratory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/login/laboratory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": "pascal@sante.dz",
        "name": "pascal",
        "description": null,
        "wilaya_id": 16
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "laboratory not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Wrong pass word"
}
```

### HTTP Request
`POST api/login/laboratory`


<!-- END_e6e4034921b80408432429d41a17cfca -->

#Patients management


APIs for managing Patient
<!-- START_cdf5e02e9b913556f9304546d59e6c56 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/patients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/patients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "first_name": "abdelaziz",
            "last_name": "bouteflika",
            "phone": "0666666666",
            "email": null,
            "address": null
        },
        {
            "id": 2,
            "first_name": "donald",
            "last_name": "trump",
            "phone": null,
            "email": null,
            "address": null
        },
        {
            "id": 3,
            "first_name": "abdelmalek",
            "last_name": "sellal",
            "phone": "07777777777",
            "email": null,
            "address": null
        }
    ]
}
```

### HTTP Request
`GET api/patients`


<!-- END_cdf5e02e9b913556f9304546d59e6c56 -->

<!-- START_9595666a103e105bb3f677f002653307 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/patients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"mohamed","last_name":"habi","phone":"16 98 7767 89","address":"setif","email":"ministere@sante.dz","password":".............."}'

```

```javascript
const url = new URL(
    "http://localhost/api/patients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "mohamed",
    "last_name": "habi",
    "phone": "16 98 7767 89",
    "address": "setif",
    "email": "ministere@sante.dz",
    "password": ".............."
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "first_name": "aziz",
        "last_name": "boutef",
        "phone": "07779261738",
        "email": null,
        "address": null
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The id has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/patients`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `first_name` | string |  required  | first_name .
        `last_name` | string |  required  | last_name.
        `phone` | string |  optional  | phone number.
        `address` | string |  optional  | The address.
        `email` | string |  optional  | email.
        `password` | string |  optional  | password of the patient.
    
<!-- END_9595666a103e105bb3f677f002653307 -->

<!-- START_e21961238df73c8544f00766ed069000 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/patients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/patients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "first_name": "aziz",
        "last_name": "boutef",
        "phone": "07779261738",
        "email": null,
        "address": null
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "patient not found"
}
```

### HTTP Request
`GET api/patients/{patient}`


<!-- END_e21961238df73c8544f00766ed069000 -->

<!-- START_7b1b54123a6d30586c3e445437e73fd5 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/patients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/patients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "first_name": "aziz",
        "last_name": "boutef",
        "phone": "07779261738",
        "email": null,
        "address": null
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "patient not found"
}
```

### HTTP Request
`PUT api/patients/{patient}`

`PATCH api/patients/{patient}`


<!-- END_7b1b54123a6d30586c3e445437e73fd5 -->

<!-- START_91030317441de3d43a948f7948db4fe7 -->
## Remove the specified patient from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/patients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/patients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "patient deleted"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "patient not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Database server error"
}
```

### HTTP Request
`DELETE api/patients/{patient}`


<!-- END_91030317441de3d43a948f7948db4fe7 -->

#Tests management


APIs for managing Tests
<!-- START_0bef4e738c9d6720ad43b062015d1078 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "disease_id": "Covid_19",
            "patient_id": 1,
            "hospital_id": "pacha@sante.dz",
            "laboratory_id": "pasteur@sante.dz",
            "positif": 1
        },
        {
            "id": 2,
            "disease_id": "Covid_19",
            "patient_id": 2,
            "hospital_id": "pacha@sante.dz",
            "laboratory_id": "pasteur@sante.dz",
            "positif": 1
        },
        {
            "id": 3,
            "disease_id": "Covid_19",
            "patient_id": 3,
            "hospital_id": "saadna@sante.dz",
            "laboratory_id": "pasteur@sante.dz",
            "positif": null
        }
    ]
}
```

### HTTP Request
`GET api/test`


<!-- END_0bef4e738c9d6720ad43b062015d1078 -->

<!-- START_50c0a334d57bffdf48ce568bad023ce0 -->
## Store a newly created Test in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"disease_id":"Covid_19","patient_id":"3","hospital_id":"jcp@sante.dz","laboratory_id":"pascal@sante.dz"}'

```

```javascript
const url = new URL(
    "http://localhost/api/test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "disease_id": "Covid_19",
    "patient_id": "3",
    "hospital_id": "jcp@sante.dz",
    "laboratory_id": "pascal@sante.dz"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "disease_id": "Covid_19",
        "patient_id": 3,
        "hospital_id": "set@sante.dz",
        "laboratory_id": "pascal@sante.dz",
        "positif": 1
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The disease_id is required."
        ]
    }
}
```

### HTTP Request
`POST api/test`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `disease_id` | string |  required  | disease_id .
        `patient_id` | string |  required  | patient_id.
        `hospital_id` | string |  required  | hospital_id.
        `laboratory_id` | string |  required  | laboratory_id.
    
<!-- END_50c0a334d57bffdf48ce568bad023ce0 -->

<!-- START_0e7fdfc917574c772941bb990e1e6826 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/test/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/test/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "disease_id": "Covid_19",
        "patient_id": 3,
        "hospital_id": "set@sante.dz",
        "laboratory_id": "pascal@sante.dz",
        "positif": 1
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "test not found"
}
```

### HTTP Request
`GET api/test/{test}`


<!-- END_0e7fdfc917574c772941bb990e1e6826 -->

<!-- START_b446b9637348bf83b7e1446be6867356 -->
## Test result

> Example request:

```bash
curl -X POST \
    "http://localhost/api/test/response" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":3,"positif":false}'

```

```javascript
const url = new URL(
    "http://localhost/api/test/response"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 3,
    "positif": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "disease_id": "Covid_19",
        "patient_id": 3,
        "hospital_id": "set@sante.dz",
        "laboratory_id": "pascal@sante.dz",
        "positif": 1
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "test not found"
}
```

### HTTP Request
`POST api/test/response`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | test_id .
        `positif` | boolean |  required  | test result.
    
<!-- END_b446b9637348bf83b7e1446be6867356 -->

<!-- START_65e2f1ddb83c19139e47b7de5da9dfd7 -->
## Get all tests for a given laboratory

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/test/laboratory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/test/laboratory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET api/test/laboratory/{id}`


<!-- END_65e2f1ddb83c19139e47b7de5da9dfd7 -->

<!-- START_bb12dcb912eda8134ee3eebd68022beb -->
## Get all tests for a given hospital

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/test/hospital/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/test/hospital/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET api/test/hospital/{id}`


<!-- END_bb12dcb912eda8134ee3eebd68022beb -->

<!-- START_75b67f5c13a24a7aebb466cd3830e2a6 -->
## Get all tests for a given patient

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/test/patient/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/test/patient/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "disease_id": "Covid_19",
        "patient_id": 1,
        "hospital_id": "pacha@sante.dz",
        "laboratory_id": "pasteur@sante.dz",
        "created_at": "2020-06-15T00:11:47.000000Z",
        "updated_at": "2020-06-15T00:16:00.000000Z",
        "positif": 1
    }
]
```

### HTTP Request
`GET api/test/patient/{id}`


<!-- END_75b67f5c13a24a7aebb466cd3830e2a6 -->

<!-- START_97f65c66d837f41e3d23414f6b57579e -->
## Get all tests for a given disease

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/test/disease/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/test/disease/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET api/test/disease/{id}`


<!-- END_97f65c66d837f41e3d23414f6b57579e -->

#Wilayas management


APIs for managing Wilayas
<!-- START_292d984bd4d4850c027b2e1a337d3a69 -->
## Display a listing of the Wilayas.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/wilayas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/wilayas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "name": "Adrar"
        },
        {
            "id": 2,
            "name": "Chlef"
        },
        {
            "id": 3,
            "name": "Laghouat"
        },
        {
            "id": 4,
            "name": "Oum El Bouaghi"
        },
        {
            "id": 5,
            "name": "Batna"
        },
        {
            "id": 6,
            "name": "Béjaïa"
        },
        {
            "id": 7,
            "name": "Biskra"
        },
        {
            "id": 8,
            "name": "Béchar"
        },
        {
            "id": 9,
            "name": "Blida"
        },
        {
            "id": 10,
            "name": "Bouira"
        },
        {
            "id": 11,
            "name": "Tamanrasset"
        },
        {
            "id": 12,
            "name": "Tébessa"
        },
        {
            "id": 13,
            "name": "Tlemcen"
        },
        {
            "id": 14,
            "name": "Tiaret"
        },
        {
            "id": 15,
            "name": "Tizi Ouzou"
        },
        {
            "id": 16,
            "name": "Alger"
        },
        {
            "id": 17,
            "name": "Djelfa"
        },
        {
            "id": 18,
            "name": "Jijel"
        },
        {
            "id": 19,
            "name": "Sétif"
        },
        {
            "id": 20,
            "name": "Saïda"
        },
        {
            "id": 21,
            "name": "Skikda"
        },
        {
            "id": 22,
            "name": "Sidi Bel Abbès"
        },
        {
            "id": 23,
            "name": "Annaba"
        },
        {
            "id": 24,
            "name": "Guelma"
        },
        {
            "id": 25,
            "name": "Constantine"
        },
        {
            "id": 26,
            "name": "Médéa"
        },
        {
            "id": 27,
            "name": "Mostaganem"
        },
        {
            "id": 28,
            "name": "MSila"
        },
        {
            "id": 29,
            "name": "Mascara"
        },
        {
            "id": 30,
            "name": "Ouargla"
        },
        {
            "id": 31,
            "name": "Oran"
        },
        {
            "id": 32,
            "name": "El Bayadh"
        },
        {
            "id": 33,
            "name": "Illizi"
        },
        {
            "id": 34,
            "name": "Bordj Bou Arreridj"
        },
        {
            "id": 35,
            "name": "Boumerdès"
        },
        {
            "id": 36,
            "name": "El Tarf"
        },
        {
            "id": 37,
            "name": "Tindouf"
        },
        {
            "id": 38,
            "name": "Tissemsilt"
        },
        {
            "id": 39,
            "name": "El Oued"
        },
        {
            "id": 40,
            "name": "Khenchela"
        },
        {
            "id": 41,
            "name": "Souk Ahras"
        },
        {
            "id": 42,
            "name": "Tipaza"
        },
        {
            "id": 43,
            "name": "Mila"
        },
        {
            "id": 44,
            "name": "Aïn Defla"
        },
        {
            "id": 45,
            "name": "Naâma"
        },
        {
            "id": 46,
            "name": "Aïn Témouchent"
        },
        {
            "id": 47,
            "name": "Ghardaïa"
        },
        {
            "id": 48,
            "name": "Relizane"
        }
    ]
}
```

### HTTP Request
`GET api/wilayas`


<!-- END_292d984bd4d4850c027b2e1a337d3a69 -->

<!-- START_26ab8af0702d9e43fffe3ca25cf001e8 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/wilayas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":19,"wilaya_name":"setif"}'

```

```javascript
const url = new URL(
    "http://localhost/api/wilayas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 19,
    "wilaya_name": "setif"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 19,
        "name": "setif"
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The id has already been taken."
        ],
        "wilaya_name": [
            "The wilaya name has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/wilayas`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | wilaya id .
        `wilaya_name` | string |  required  | wilaya_name.
    
<!-- END_26ab8af0702d9e43fffe3ca25cf001e8 -->

<!-- START_84e504e29bad60beca012e305da3ffcc -->
## Display the specified wilaya.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/wilayas/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/wilayas/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 19,
        "name": "setif"
    }
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "wilaya not found"
}
```

### HTTP Request
`GET api/wilayas/{wilaya}`


<!-- END_84e504e29bad60beca012e305da3ffcc -->

<!-- START_81de45d36808d042f69b7a2710c972c7 -->
## Remove the specified wilaya from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/wilayas/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/wilayas/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "message": "wilaya deleted"
}
```
> Example response (404):

```json
{
    "status": "error",
    "message": "wilaya not found"
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": "Database server error"
}
```

### HTTP Request
`DELETE api/wilayas/{wilaya}`


<!-- END_81de45d36808d042f69b7a2710c972c7 -->

#general


<!-- START_2f674d16f20a26fc449e6ad3200dc907 -->
## Display a listing of the DeseasesHospital.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/deseases_hospital" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/deseases_hospital"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "disease_id": "Covid_19",
            "patient_id": 1,
            "hospital_id": "pacha@sante.dz",
            "laboratory_id": null,
            "cured": 0
        },
        {
            "disease_id": "Covid_19",
            "patient_id": 2,
            "hospital_id": "pacha@sante.dz",
            "laboratory_id": null,
            "cured": 0
        }
    ]
}
```

### HTTP Request
`GET api/deseases_hospital`


<!-- END_2f674d16f20a26fc449e6ad3200dc907 -->

<!-- START_f4dc7ea998aa34c88ceb2933dea86a20 -->
## Store a newly created DeseasesHospital in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/deseases_hospital" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"disease_id":"Covid_19","patient_id":"3","hospital_id":"jcp@sante.dz"}'

```

```javascript
const url = new URL(
    "http://localhost/api/deseases_hospital"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "disease_id": "Covid_19",
    "patient_id": "3",
    "hospital_id": "jcp@sante.dz"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "disease_id": "Covid_19",
        "patient_id": 3,
        "hospital_id": "set@sante.dz",
        "cured": 1
    }
}
```
> Example response (500):

```json
{
    "status": "error",
    "message": {
        "id": [
            "The disease_id is required."
        ]
    }
}
```

### HTTP Request
`POST api/deseases_hospital`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `disease_id` | string |  required  | disease_id .
        `patient_id` | string |  required  | patient_id.
        `hospital_id` | string |  required  | hospital_id.
    
<!-- END_f4dc7ea998aa34c88ceb2933dea86a20 -->

<!-- START_43bd394f71fb6ea01845852eb86d7607 -->
## If someone is cured hhh

> Example request:

```bash
curl -X POST \
    "http://localhost/api/deseases_hospital/cure" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"disease_id":"Covid_19","patient_id":3,"hospital_id":"bacha@sante.dz","cured":true}'

```

```javascript
const url = new URL(
    "http://localhost/api/deseases_hospital/cure"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "disease_id": "Covid_19",
    "patient_id": 3,
    "hospital_id": "bacha@sante.dz",
    "cured": true
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success"
}
```

### HTTP Request
`POST api/deseases_hospital/cure`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `disease_id` | string |  required  | disease_id .
        `patient_id` | integer |  required  | patient_id .
        `hospital_id` | string |  required  | hospital_id .
        `cured` | boolean |  required  | test cured.
    
<!-- END_43bd394f71fb6ea01845852eb86d7607 -->

<!-- START_7c36c79f8bbf25a1657ff2545379d351 -->
## true if the perdon is dead

> Example request:

```bash
curl -X POST \
    "http://localhost/api/deseases_hospital/dead" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"disease_id":"Covid_19","patient_id":3,"hospital_id":"bacha@sante.dz","dead":false}'

```

```javascript
const url = new URL(
    "http://localhost/api/deseases_hospital/dead"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "disease_id": "Covid_19",
    "patient_id": 3,
    "hospital_id": "bacha@sante.dz",
    "dead": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success"
}
```

### HTTP Request
`POST api/deseases_hospital/dead`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `disease_id` | string |  required  | disease_id .
        `patient_id` | integer |  required  | patient_id .
        `hospital_id` | string |  required  | hospital_id .
        `dead` | boolean |  required  | dead.
    
<!-- END_7c36c79f8bbf25a1657ff2545379d351 -->

<!-- START_19ed32d31be0628c44f251a3d2f1d950 -->
## Returns the statistics of a wilaya

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/stat/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/stat/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "cured": [],
    "not_cured": []
}
```

### HTTP Request
`GET api/stat/{wilaya}`


<!-- END_19ed32d31be0628c44f251a3d2f1d950 -->

<!-- START_c5a2ae4a8a8cbeb1fa7c1b2e52ded22a -->
## Returns the statistics of all the contry

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/stat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/stat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "cured": [],
    "not_cured": [
        {
            "wilaya_id": 16,
            "disease_id": "Covid_19",
            "patient_id": 1,
            "id": "pacha@sante.dz",
            "cured": 0
        },
        {
            "wilaya_id": 16,
            "disease_id": "Covid_19",
            "patient_id": 2,
            "id": "pacha@sante.dz",
            "cured": 0
        }
    ]
}
```

### HTTP Request
`GET api/stat`


<!-- END_c5a2ae4a8a8cbeb1fa7c1b2e52ded22a -->


