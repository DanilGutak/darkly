## Easter Egg Vulnerability

### Summary
A hidden page ("easter egg") was discovered via a link in the website footer. Accessing this page with specific HTTP headers reveals sensitive information (flag).

### Methodology
1. Located the hidden page:
  ```
  http://localhost:8080/index.php?page=b7e44c7a40c5f80139f0a50f3650fb2bd8d00b0d24667c4c2ca32c88e13b758f
  ```
2. Found comments indicating required headers:
  - Referer: `https://www.nsa.gov/`
  - User-Agent: `ft_bornToSec`
3. Crafted a request using curl:
  ```bash
  curl 'http://localhost:8080/index.php?page=b7e44c7a40c5f80139f0a50f3650fb2bd8d00b0d24667c4c2ca32c88e13b758f' \
    -H 'Referer: https://www.nsa.gov/' \
    -H 'User-Agent: ft_bornToSec' | grep flag
  ```
4. The server responded with the flag when the correct headers were present.

### Findings
- Sensitive information is accessible via a hidden page when specific headers are used.
- The presence of "easter eggs" in production code can lead to unintended information disclosure.

### Recommendation
- Remove hidden pages and "easter eggs" from production environments.
- Avoid relying on HTTP headers for access control.
- Conduct regular code reviews to identify and eliminate such risks.
