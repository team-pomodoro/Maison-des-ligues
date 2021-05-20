<?php

namespace App\Repository;

use App\Entity\Compte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Compte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compte[]    findAll()
 * @method Compte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRepository extends ServiceEntityRepository implements PasswordUpgraderInterface {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Compte::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void {
        if (!$user instanceof Compte) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * verifie que le numero de licence existe deja dans la bdd
     * @return bool
     */
    public function numLicenceExist(int $num_licence): bool {
        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery();//->setParameter('num_licence', $num_licence);

        $query = $entityManager->createQueryBuilder();

        $query->select('c.numLicence');
        $query->from('App\Entity\Compte', 'c');
        $query->where('c.numLicence = :num_licence');
        $query->setParameter('num_licence', $num_licence);


        return !empty($query->getQuery()->getResult());
    }

    /**
     * verifie que le numero de vérification existe deja dans la bdd
     * @return bool
     */
    public function urlActiveExist(string $url_Active): bool {
        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery();//->setParameter('num_licence', $num_licence);

        $query = $entityManager->createQueryBuilder();

        $query->select('c.urlActive');
        $query->from('App\Entity\Compte', 'c');
        $query->where('c.urlActive = :url_Active');
        $query->setParameter('url_Active', $url_Active);


        return !empty($query->getQuery()->getResult());
    }
    
    
    
     /**
     * verifie que le copte est actif par sa clé de validation
     * @return bool
     */
    public function isActive(string $url_active): bool {
        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery();//->setParameter('num_licence', $num_licence);

        $query = $entityManager->createQueryBuilder();

        $query->select('c.active');
        $query->from('App\Entity\Compte', 'c');
        $query->where('c.urlActive = :url_active');
        $query->setParameter('url_active', $url_active);

        $rez = $query->getQuery()->getResult();
       
        return $rez[0]['active'];
    }
    
    
    /**
     * verifie que le copte est actif par sa clé de validation
     * @return bool
     */
    public function activerCompte(string $url_active) {
        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery();//->setParameter('num_licence', $num_licence);

        $query = $entityManager->createQueryBuilder();

        $query->update('App\Entity\Compte','c');
        $query->set('c.active', '1');
        $query->where('c.urlActive = :url_active');
        $query->setParameter('url_active', $url_active);
        
        return $query->getQuery()->getResult();
    }
    

    // /**
    //  * @return Compte[] Returns an array of Compte objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('c')
      ->andWhere('c.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('c.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Compte
      {
      return $this->createQueryBuilder('c')
      ->andWhere('c.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
