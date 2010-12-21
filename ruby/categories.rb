require 'net/https'
require 'rexml/document'

# Your account_id number
account_id = 797 

# Substitute your username and password of course
uri = URI.parse("https://imademo:thisismypass@rad.merchantos.com:443/API/Account/#{account_id}/Category.xml?nodeDepth=0")

# API Key example
# uri = URI.parse("https://SOME_REALLY_LONG_API_KEY_STRING:apikey@rad.merchantos.com:443/API/Account/#{account_id}/Category.xml")

request = Net::HTTP::Get.new(uri.path+ '?' + uri.query) 
request.basic_auth uri.userinfo.split(':')[0], uri.userinfo.split(':')[1]

http = Net::HTTP.new(uri.host, uri.port) 
http.use_ssl = true
response = http.request(request)

xml = REXML::Document.new(response.body);
xml.elements.each('Categories/Category/name') do |name|
  puts name.text
end