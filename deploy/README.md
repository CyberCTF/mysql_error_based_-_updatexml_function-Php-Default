# MySQL Error-Based SQL Injection via UpdateXML

A deliberately vulnerable fintech payment processing application for learning MySQL error-based SQL injection techniques using the UpdateXML function.

## Quick Start

```bash
# Pull the image
docker pull cyberctf/mysql-updatexml-injection:latest

# Run the lab
docker run -d -p 3206:80 cyberctf/mysql-updatexml-injection:latest
```

## What You'll Learn

- Identify SQL injection vulnerabilities in web applications
- Craft payloads using MySQL's UpdateXML function
- Extract database information through error messages
- Understand error-based SQL injection techniques

## Lab Access

- **Application URL**: http://localhost:3206
- **Main vulnerable endpoint**: /search.php
- **Database**: MySQL 5.7 with sample transaction data

## Testing Payloads

Try these payloads in the search form:

- Basic test: `' OR '1'='1`
- Extract database name: `1' and UpdateXML(1,concat(0x7e,(select database()),0x7e),1)-- -`
- Extract database user: `1' and UpdateXML(1,concat(0x7e,(select user()),0x7e),1)-- -`

## Difficulty Level

Intermediate - Requires basic SQL knowledge and understanding of SQL injection concepts.

## Estimated Time

30-45 minutes

## Prerequisites

- Basic SQL syntax understanding
- Familiarity with web application security testing
- Web proxy tool (like Burp Suite) recommended

## Skills Developed

- Error-based SQL injection identification
- MySQL function manipulation
- Information extraction from error messages
- Web application security testing

## Report Issues

Found a bug or have a suggestion? Report it on our GitHub repository.

---

**This is a deliberately vulnerable lab designed solely for educational purposes. Do not use these techniques on systems you do not own or have explicit permission to test.** 