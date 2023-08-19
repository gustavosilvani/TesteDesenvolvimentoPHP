<?php

namespace src\Services;


use src\Domain\Entities\Coordinates;
use src\Domain\Entities\Dob;
use src\Domain\Entities\Id;
use src\Domain\Entities\Location;
use src\Domain\Entities\Login;
use src\Domain\Entities\Name;
use src\Domain\Entities\Picture;
use src\Domain\Entities\Registered;
use src\Domain\Entities\Street;
use src\Domain\Entities\Timezone;
use src\Domain\Entities\User;
use src\Domain\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function getUsers($count)
    {
        $url = "https://randomuser.me/api/?results=" . $count;
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $users = [];

        foreach ($data['results'] as $userData) {
            $user = new User(
                $userData['gender'],
                new Name(
                    $userData['name']['title'],
                    $userData['name']['first'],
                    $userData['name']['last']
                ),
                new Location(
                    new Street(
                        $userData['location']['street']['number'],
                        $userData['location']['street']['name']
                    ),
                    $userData['location']['city'],
                    $userData['location']['state'],
                    $userData['location']['country'],
                    $userData['location']['postcode'],
                    new Coordinates(
                        $userData['location']['coordinates']['latitude'],
                        $userData['location']['coordinates']['longitude']
                    ),
                    new Timezone(
                        $userData['location']['timezone']['offset'],
                        $userData['location']['timezone']['description']
                    )
                ),
                $userData['email'],
                new Login(
                    $userData['login']['uuid'],
                    $userData['login']['username'],
                    $userData['login']['password'],
                    $userData['login']['salt'],
                    $userData['login']['md5'],
                    $userData['login']['sha1'],
                    $userData['login']['sha256']
                ),
                new Dob(
                    $userData['dob']['date'],
                    $userData['dob']['age']
                ),
                new Registered(
                    $userData['registered']['date'],
                    $userData['registered']['age']
                ),
                $userData['phone'],
                $userData['cell'],
                new Id(
                    $userData['id']['name'],
                    $userData['id']['value']
                ),
                new Picture(
                    $userData['picture']['large'],
                    $userData['picture']['medium'],
                    $userData['picture']['thumbnail']
                ),
                $userData['nat']
            );

            $users[] = $user;
        }

        return $users;
    }
}