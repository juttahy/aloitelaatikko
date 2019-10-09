<?php 

    namespace App\Form;

    use App\Entity\Aloite;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class AloiteFormType extends AbstractType {

        public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder
                ->add('Aihe', TextType::class, ['label' => 'Aihe'])
                ->add('Kuvaus', TextType::class, ['label' => 'Kuvaus'])
                ->add('Kirjauspvm', DateTimeType::class, ['label' => 'Kirjauspvm'])
                ->add('Nimi', TextType::class, ['label' => 'Nimi'])
                ->add('Email', TextType::class, ['label' => 'Email'])
                ->add('save', SubmitType::class, [
                    'label' => 'Tallenna',
                    'attr' => ['class' => 'btn btn-info']
                ]);
        }

        public function configureOptions(OptionsResolver $resolver) {
            $resolver->setDefaults([
                'data-class' => Aloite::class,
            ]);
        }

    }


?>