import sys

user = sys.argv[1]
password = sys.argv[2]

if user == "user@domain.tld" and password == "123456":
    print  "ok, registered"
else: 
    print  "NOT registered"