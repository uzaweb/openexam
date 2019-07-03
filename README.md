# openexam
openexam

## 1 Create github repos https://github.com/uzaweb/openexam.git
## 2 Gen App from Rvsitebuilder7
## 3 Git commit back to github
~~~
cd /home/<user>/rvsitebuildercms/<domain_name>/packages/uzaweb/openexam

echo "# openexam" >> README.md
git init
git add *
git commit -m "first commit"
git remote add origin https://github.com/uzaweb/openexam.git
git push -u origin master
