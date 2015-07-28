import urllib.parse
import pycurl

class SlackHelper():
	"""Classe permettant d'intéragir avec l'API de Slack."""

	def __init__(self, token):
		self.token = token

	def send_message(self, name, message, emoji, channel):
		c = pycurl.Curl()
		c.setopt(c.URL, 'https://slack.com/api/chat.postMessage?token=' + self.token + '&pretty=1&username=' + urllib.parse.quote(name) + '&text='+urllib.parse.quote(message)+'&icon_emoji=:' + emoji + ':&channel=' + channel)
		c.perform()
		c.close()

	def get_channels(self):
		c = pycurl.Curl()
		c.setopt(c.URL, 'https://slack.com/api/channels.list?token=' + self.token)
		c.perform()
		c.close()

	def get_channel(self, channel):
		c = pycurl.Curl()
		c.setopt(c.URL, 'https://slack.com/api/channels.info?token=' + self.token + '&channel=' + channel + '&pretty=1')
		c.perform()
		c.close()

	def get_emoji_icons(self):
		c = pycurl.Curl()
		c.setopt(c.URL, 'https://slack.com/api/emoji.list?token=' + self.token + '&pretty=1')
		c.perform()
		c.close()
