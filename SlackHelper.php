<?php

/**
* Class SlackHelper
* Permet d'utiliser l'API de Slack
*/
class SlackHelper
{

	/**
	 * @var string Token permettant de s'identifier sur l'API de Slack
	 */
	const TOKEN = 'xoxp-7201027952-7201415569-7590424675-2e1d7c';

	/**
	 * Fonction pour envoyer des messages sur slack.
	 * @param string $name contient le nom de votre bot
	 * @param string $message contient le message qui sera envoyé à slack
	 * @param string $channel contient le nom du channel sur lequel le message sera envoyé
	 * @param string $emoji contient le nom de l'avatar de votre bot
	 * @return array $return contient la réponse retour de l'envoi en curl 
	 */
	public static function send_message_slack($name, $message, $channel, $emoji)
	{
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://slack.com/api/chat.postMessage?token='.self::TOKEN.'&pretty=1&username='.urlencode($name).'&text='.urlencode($message).'&icon_emoji=:'.$emoji.':&channel='.$channel);
	    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	    $return = curl_exec($curl);
	    
	    curl_close($curl);

	    return $return;
	}

	/**
	 * Fonction permettant de récupérer la liste des channels d'un slack.
	 * @return array $channels est un tableau contenant la liste des channels d'un slack
	 */
	public static function get_channels()
	{
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://slack.com/api/channels.list?token='.self::TOKEN.'&pretty=1');
	    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	    $data = curl_exec($curl);
	    curl_close($curl);

	    $data = json_decode($data);
	    $channels = array();

	    foreach ($data->channels as $channel) {
	    	$channels[$channel->id] = $channel->name;
	    }

	    return $channels;
	}

	/**
	 * Fonction permettant de récupérer les infos d'un channel d'un slack.
	 * @param string $channel_code contient le code d'un channel qui appartient au Slack appelé grâce au token
	 * @return object $channel est un objet contenant les informations d'un channel d'un slack
	 */
	public static function get_channel($channel_code)
	{
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://slack.com/api/channels.info?token='.self::TOKEN.'&channel='.$channel_code.'&pretty=1');
	    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	    $data = curl_exec($curl);
	    curl_close($curl);

	    $channel = json_decode($data);

	    return $channel;
	}

	/**
	 * Fonction permettant de récupérer la liste des emojis d'un slack.
	 * @return array $emojis est un tableau contenant la liste des emojis d'un slack
	 */
	public static function get_emoji_icons()
	{
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://slack.com/api/emoji.list?token='.self::TOKEN.'&pretty=1');
	    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	    $data = curl_exec($curl);
	    curl_close($curl);

	    $data = json_decode($data);
	    $emojis = array();

	    foreach ($data->emoji as $key => $value) {
	        $emojis[$key] = $value;
	    }

	    return $emojis;
	}

}
