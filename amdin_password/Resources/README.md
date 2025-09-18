## Laboratory Report: Admin Password Exposure via robots.txt

### Summary
A vulnerability was discovered through information leakage in the `robots.txt` file, leading to exposure of admin credentials and unauthorized access to the admin panel.

### Methodology
1. Inspected `robots.txt` and found disallowed paths:
	```
	User-agent: *
	Disallow: /whatever
	Disallow: /.hidden
	```
2. Accessed the `/whatever/` directory:
	```
	http://localhost:8080/whatever/
	```
3. Discovered a password file and retrieved its contents:
	```bash
	curl http://localhost:8080/whatever/htpasswd
	```
	- Output: `root:437394baff5aa33daa618be47b75cb49`
4. Decrypted the password hash, revealing:
	- Password: `qwerty123@`
5. Used the credentials to log in to the admin panel:
	```
	http://localhost:8080/admin/
	```
	- Successfully accessed the admin area and obtained the flag.

### Findings
- Sensitive paths listed in `robots.txt` can be easily discovered and accessed.
- Storing password files in web-accessible directories exposes credentials to attackers.
- Weak password management and lack of access controls facilitate unauthorized access.

### Recommendation
- Avoid listing sensitive directories in `robots.txt`.
- Store credential files outside of the web root and restrict access.
- Implement strong authentication and regular password audits.
