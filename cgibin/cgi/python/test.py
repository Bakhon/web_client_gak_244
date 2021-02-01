import sys
from mod_python import apache
def handler(req):
  req.content_type = 'text/html'
  req.write('<html>')
  req.write('<head>')
  req.write('<title>Hello Word - First CGI Program</title>')
  req.write('</head>')
  req.write('<body>')
  req.write('<h2>Hello Word! dsdfsd This is my first CGI program</h2>')
  req.write('</body>')
  req.write('</html>') 
  return apache.OK  