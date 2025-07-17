#!/usr/bin/env python3
"""
Test runner for MySQL Error-Based SQL Injection lab
Runs automated tests to verify the vulnerability and exploit functionality
"""

import subprocess
import sys
import time
import requests
from pathlib import Path

def wait_for_app(base_url="http://localhost:3206", timeout=60):
    """Wait for the application to be ready"""
    print(f"⏳ Waiting for application at {base_url}...")
    start_time = time.time()
    
    while time.time() - start_time < timeout:
        try:
            response = requests.get(base_url, timeout=5)
            if response.status_code == 200:
                print("✅ Application is ready!")
                return True
        except requests.RequestException:
            pass
        time.sleep(2)
    
    print("❌ Application not ready within timeout")
    return False

def run_pytest_tests():
    """Run pytest tests"""
    print("\n🧪 Running automated tests...")
    
    # Change to test directory
    test_dir = Path(__file__).parent
    original_dir = Path.cwd()
    
    try:
        # Install requirements if needed
        subprocess.run([sys.executable, "-m", "pip", "install", "-r", "requirements.txt"], 
                      cwd=test_dir, check=True)
        
        # Run tests
        result = subprocess.run([sys.executable, "-m", "pytest", "test_sql_injection.py", "-v"], 
                              cwd=test_dir, capture_output=True, text=True)
        
        print(result.stdout)
        if result.stderr:
            print("STDERR:", result.stderr)
        
        return result.returncode == 0
        
    except subprocess.CalledProcessError as e:
        print(f"❌ Error running tests: {e}")
        return False
    finally:
        os.chdir(original_dir)

def run_auto_solve():
    """Run auto-solve functionality"""
    print("\n🎯 Running auto-solve exploit...")
    
    test_dir = Path(__file__).parent
    original_dir = Path.cwd()
    
    try:
        # Install requirements if needed
        subprocess.run([sys.executable, "-m", "pip", "install", "-r", "requirements.txt"], 
                      cwd=test_dir, check=True)
        
        # Run auto-solve
        result = subprocess.run([sys.executable, "test_sql_injection.py"], 
                              cwd=test_dir, capture_output=True, text=True)
        
        print(result.stdout)
        if result.stderr:
            print("STDERR:", result.stderr)
        
        return result.returncode == 0
        
    except subprocess.CalledProcessError as e:
        print(f"❌ Error running auto-solve: {e}")
        return False
    finally:
        os.chdir(original_dir)

def main():
    """Main test runner"""
    print("🚀 MySQL Error-Based SQL Injection Lab - Test Runner")
    print("=" * 60)
    
    # Check if application is running
    if not wait_for_app():
        print("\n❌ Please start the application first:")
        print("   docker-compose up --build")
        sys.exit(1)
    
    # Run tests
    tests_passed = run_pytest_tests()
    
    # Run auto-solve
    auto_solve_passed = run_auto_solve()
    
    # Summary
    print("\n" + "=" * 60)
    print("📊 TEST SUMMARY")
    print("=" * 60)
    print(f"Automated Tests: {'✅ PASSED' if tests_passed else '❌ FAILED'}")
    print(f"Auto-Solve: {'✅ PASSED' if auto_solve_passed else '❌ FAILED'}")
    
    if tests_passed and auto_solve_passed:
        print("\n🎉 All tests passed! The lab is working correctly.")
        sys.exit(0)
    else:
        print("\n⚠️  Some tests failed. Please check the application setup.")
        sys.exit(1)

if __name__ == "__main__":
    import os
    main() 