<?php
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    
    class JSONWT{

        public static function generateToken($data = [], $expirationTime = NULL){
            $payload = [];
            $response = [];

            if(count($data)>0){
                foreach ($data as $key=>$value) {
                    $payload[$key] = $value;
                }
            }

            if($expirationTime != NULL){
                $payload['exp'] = time() + $expirationTime;
                $response['exp'] = $payload['exp'];
            }

            $response['token'] = JWT::encode($payload, CRYPTO_KEY, ENCRYPT);

            return $response;
        }

        public static function validateToken($token){
            try {
                $decoded = JWT::decode($token, new Key(CRYPTO_KEY, ENCRYPT));
                return $decoded;
            } catch (Exception $e) {
                return false;
            }
        }
    }
?>