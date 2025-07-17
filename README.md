# MySQL Error-Based SQL Injection via UpdateXML

Learn to exploit MySQL error-based SQL injection using the UpdateXML function to extract critical database information for further compromise.

## Description

This lab demonstrates a vulnerable fintech payment processing application called QuickPay. The application contains a search functionality that is vulnerable to SQL injection through the UpdateXML function, allowing attackers to extract sensitive database information through error messages.

## Objectives

- Identify a SQL injection vulnerability
- Craft a payload using the UpdateXML function
- Extract the database name using error-based SQL injection
- Extract the database user similarly

## Difficulty

Intermediate

## Estimated Time

30-45 minutes

## Prerequisites

- Basic SQL syntax
- Understanding of SQL injection
- Familiarity with MySQL functions
- Using web proxies like Burp Suite

## Skills Learned

- Identifying error-based SQL injection points
- Manipulating MySQL error output with UpdateXML
- Extracting information from error messages

## Project Structure

```
├── build/           # Application source code
├── deploy/          # Docker configuration
├── test/            # Automated tests
├── docs/            # Documentation
├── README.md        # This file
└── .gitignore
```

## Quick Start

### Prerequisites

Docker and Docker Compose installed locally.

### Installation

1. Clone the repository
2. Navigate to the project directory
3. Run the application:
   ```bash
   docker-compose up --build
   ```
4. Visit http://localhost:3206 and start testing the /search.php endpoint

## How to Use

1. Access the QuickPay application at http://localhost:3206
2. Navigate to the "Transaction Search" page
3. Test the search functionality for SQL injection vulnerabilities
4. Use the UpdateXML function to extract database information

## Vulnerability Details

The search functionality in `/search.php` is vulnerable to SQL injection due to improper input sanitization. The application directly concatenates user input into SQL queries without proper parameterization, allowing malicious SQL code to be executed.

## Testing Payloads

- Basic SQL injection test: `' OR '1'='1`
- Database name extraction: `1' and UpdateXML(1,concat(0x7e,(select database()),0x7e),1)-- -`
- Database user extraction: `1' and UpdateXML(1,concat(0x7e,(select user()),0x7e),1)-- -`

## Issue Tracker

Report issues at: https://github.com/ctf-labs/mysql-updatexml-injection/issues

## Disclaimer

This is a deliberately vulnerable lab designed solely for educational purposes. Do not use these techniques on systems you do not own or have explicit permission to test. 