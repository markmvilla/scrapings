'''
Created on Jan 5, 2016

@author: MarkVilla
'''
import sys
from BeautifulSoup import BeautifulSoup
import re
import requests
import urllib
import os
from os.path import basename
import urlparse

textFile = open('/path/to/catalog.txt', "w")

#enter URL to catalog site
r  = requests.get("http://tcu.smartcatalogiq.com/en/current/Undergraduate-Catalog/Courses")
soup = BeautifulSoup(r.text)
#searching for courses to iterate
ul = soup.find('ul',{'class':'sc-child-item-links'})
for li in ul.findAll('a'):
    litext = li.text
    if litext[litext.find("-")-1] != " ":
        result = litext[0:[litext.find("-")][0]] + " " + litext[[litext.find("-")][0]] + " " + litext[([litext.find("-")][0]+1):len(litext)]
        textFile.write(result + '\n')
        print result
    else:
        textFile.write(litext + '\n')
        print litext
    #searching for classes for each course
    r = requests.get("http://tcu.smartcatalogiq.com/" + li['href'])
    soup = BeautifulSoup(r.text)
    ul = soup.find('div',{'id':'main'}).ul
    for secondli in ul.findAll('a'):
         secondlitest = secondli.text
         textFile.write(secondlitest + '\n')
         print secondlitest

textFile.close()
