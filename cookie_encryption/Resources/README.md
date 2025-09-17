## Laboratory Report: Weak Cookie Encryption Vulnerability

### Methodology
1. Identified that the cookie value appears to be an MD5 hash.
2. Used an online hash cracker (e.g., https://crackstation.net) to test the hash value.
3. Verified the hash using the following command:
	```
	md5 -s false
	```
	Result matches the cookie value
4. Generated a new hash for the string 'true':
	```
	md5 -s true
	```
5. Replaced the cookie value with the new hash and accessed the website.

### Findings
- The cookie encryption uses MD5, which is considered cryptographically weak and easily reversible.
- The hash for 'false' is publicly crackable, allowing attackers to manipulate authentication states.
- Changing the cookie to the hash of 'true' grants unauthorized access (e.g., reveals the next flag).

### Recommendation
- Replace MD5 with a secure, modern hashing algorithm (e.g., SHA-256 or bcrypt).
- Implement proper authentication and session management to prevent tampering.
