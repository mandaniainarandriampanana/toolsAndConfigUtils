<?php
public function exportDataUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('MatelliUserBundle:User')->findAll();
// Add the data queried from database
        $handle = fopen('php://memory', 'r+');
//Set the UTF-8 BOM
        fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
//Set the TITRE
        fputcsv($handle, array(
            'id',
            'email',
            'email_canonical',
            'salt',
            'password',
            'username',
            'username_canonical',
            'enabled',
            /* 'last_login',
              'locked',
              'expired',
              'expired_at',
              'confirmmation_token',
              'password_requested_at', */
            'roles',
            /* 'credentials_expired',
              'credentials_expire_at', */
            'nom',
            'prenom',
            'phone',
            'adresse',
            'code_postal',
            'ville',
            'fonction',
            'statut',
            'profil',
            'num_rpps',
            'mode_exercice',
            'is_actif',
            'mode_exercice',
            'titre',
            'technical_id'
            ), ';');
        foreach ($users as $user) {
            fputcsv($handle, array(
                $user->getId(),
                $user->getEmail(),
                $user->getEmailCanonical(),
                $user->getSalt(),
                $user->getPassword(),
                $user->getUserName(),
                $user->getUsernameCanonical(),
                $user->IsEnabled(),
                /* $user->getLastLogin() ? $user->getLastLogin()->format('Y-m-d H:i:s') : '',
                  $user->IsLocked(),
                  $user->IsExpired(),
                  '',
                  $user->getConfirmationToken(),
                  //$user->getPasswordRequestedAt()->format('Y-m-d H:i:s'),
                  '', */
                json_encode($user->getRoles()),
                /* 0,
                  '', */
                $user->getNom(),
                $user->getPrenom(),
                $user->getPhone(),
                $user->getAdresse(),
                $user->getCodePostal(),
                $user->getVille(),
                $user->getFonction(),
                $user->getStatut(),
                $user->getProfil(),
                $user->getNumRPPS(),
                $user->getModeExercice(),
                $user->getIsActive(),
                $user->getModeExercice(),
                "",
                ""
                ), ';');
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        return new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="export_utilisateurs.xls"'
        ));