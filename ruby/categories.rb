require 'net/http'
require 'rexml/document'

# Your account_id number
account_id = 001 
api_key = 010101010101010101010

uri = URI('https://api.merchantos.com/API/Account/#{account_id}/Category.xml')
response = Net::HTTP.start(uri.host, uri.port, :use_ssl => uri.scheme == 'https') do |http|
  request = Net::HTTP::Get.new uri.request_uri
  # or use username and password instead (not recommended)
  # request.basic_auth username, password
	request.basic_auth api_key
	response = http.request request
end

xml = REXML::Document.new(response.body);

xml.elements.each('Categories/Category/name') do |name|
  puts name.text
end
