 <?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 * 
 * @package        Google Drive Requester
 * @author        Virgil B.
 * @author        Sylvain Frigui <sf@hands.agency>
 * @copyright    Copyright © 2004-2014, Grand Central
 * @license        http://www.cafecentral.fr/fr/licences GNU Public License
 * @access        public
 * @link        http://www.cafecentral.fr/fr/wiki
 */
class GoogleDrive {
    
    var $drive;
    var $service;
    var $credentials;
    var $conn;
     var    $client_id,
            $client_secret,
            $redirect_uri,
            //$user_id,
            $email_address;
            
    var $scopes = array(
                'https://www.googleapis.com/auth/drive',
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile'
            );
            
    function __construct($params,$getauthorization=false)
	{
         
        foreach($params as $key => $param)
		{
             $this->$key = $param;
        }
         
        $this->conn = new GoogleConnect($params,$this->scopes,$getauthorization=false);
        
        $this->credentials = $this->conn->getCredentials();
        
        $this->service = $this->buildDriveService();
    }
    
    function buildDriveService() {
        
        $apiClient = new Google_Client();
        $apiClient->setClientId($this->client_id);
        $apiClient->setClientSecret($this->client_secret);
        //$apiClient->setUseObjects(true);
        $apiClient->setAccessToken($this->credentials);
        return new Google_Service_Drive($apiClient);
      
    }
    
    function listFiles($params = array()){
        $result = array();
        $pageToken = NULL;

        do {
            try {

                $parameters = $params;
                if ($pageToken) {
                $parameters['pageToken'] = $pageToken;
                }
                $files = $this->service->files->listFiles($parameters);

                $result = array_merge($result, $files->getItems());
                $pageToken = $files->getNextPageToken();
            } catch (Exception $e) {
                print "An error occurred: " . $e->getMessage();
                $pageToken = NULL;
            }
        } while ($pageToken);
        return $result;    
    }

    function getChildrenFolders($folderId,$fields = ''){
        $params['q'] = "'".$folderId."' in parents and mimeType='application/vnd.google-apps.folder'";
        if(!empty($fields))
            $params['fields'] = $fields; // should filter returned fields... but doesn't
            
        return $this->listFiles($params);
    }

    function getChildrenFiles($folderId,$fields = ''){
        $params['q'] = "'".$folderId."' in parents and mimeType!='application/vnd.google-apps.folder'";
        if(!empty($fields))
            $params['fields'] = $fields; // should filter returned fields... but doesn't
            
        return $this->listFiles($params);
    }

    function getAllChildrenItems($folderId,$fields = ''){
        $params['q'] = "'".$folderId."' in parents ";
        if(!empty($fields))
            $params['fields'] = $fields; // should filter returned fields... but doesn't
            
        return $this->listFiles($params);
    }

	function uploadFile($filePath, $mimeType, $driveFolderId, $title, $descr)
	{
		$service = $this->service;
		$parentId = 'test';
		
	//	Insert a file
		$file = new Google_Service_Drive_DriveFile();
		$file->setTitle($title);
		$file->setDescription($descr);
		$file->setMimeType($mimeType);
		
	//	Folder
		if ($driveFolderId)
		{
			$parent = new Google_Service_Drive_ParentReference();
			$parent->setId($driveFolderId);
			$file->setParents(array($parent));
		}

		$data = file_get_contents($filePath);

		$createdFile = $service->files->insert(
			$file, array(
				'data' => $data,
         		'mimeType'   => $mimeType,
         		'convert' => true,
         		'uploadType' => 'media',
			)
		);
	}
    
}