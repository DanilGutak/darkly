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

