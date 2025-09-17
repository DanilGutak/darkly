## SQL Injection Vulnerability (Image List)

### Summary
A SQL injection vulnerability was identified in the image listing functionality. User input is directly embedded into SQL queries without proper validation or sanitization, allowing attackers to manipulate database queries and extract sensitive information.

### Methodology
1. Determined the relevant table and fields in the database schema.
2. Used a UNION-based injection to extract data:
	```sql
	1 union select comment, title from list_images
	```
3. The query returned a hint containing an MD5 hash: `1928e8083cf461a51303633093573c46`.
4. Decoded the hash using https://crackstation.net, which revealed the value: `albatroz`.
5. Converted the result to lowercase and generated its SHA-256 hash for flag submission:
	```
	sha256 -s albatroz
	```

### Findings
- The application is vulnerable to SQL injection, exposing image comments, titles, and other internal data.
- Attackers can enumerate tables, columns, and extract sensitive information, including hints and flags.

### Recommendation
- Implement parameterized queries and input validation to prevent SQL injection.
- Regularly audit code for insecure database interactions.
