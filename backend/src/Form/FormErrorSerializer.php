<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Validator\ViolationMapper\ViolationMapper;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolation;

class FormErrorSerializer
{
    /**
     * @var ViolationMapper
     */
    private ViolationMapper $mapper;

    /**
     * FormErrorsSerializer constructor.
     */
    public function __construct()
    {
        $this->mapper = new ViolationMapper();
    }

    /**
     * @param FormInterface $form
     * @param bool $flatArray
     * @param bool $addFormName
     * @param string $glueKeys
     *
     * @return array
     */
    public function serializeFormErrors(FormInterface $form, bool $flatArray = false, bool $addFormName = false, string $glueKeys = '_'): array
    {
        $errors = [];
        $errors['global'] = [];
        $errors['fields'] = [];

        foreach ($form->getErrors() as $error) {
            $errors['global'][] = $error->getMessage();
        }

        $errors['fields'] = $this->serialize($form);

        if ($flatArray) {
            $errors['fields'] = $this->arrayFlatten(
                $errors['fields'],
                $glueKeys,
                (($addFormName) ? $form->getName() : '')
            );
        }

        return $errors;
    }


    /**
     * @param FormInterface $form
     *
     * @return array
     */
    private function serialize(FormInterface $form): array
    {
        $localErrors = [];

        if ($form->getErrors()->count() > 0) {
            foreach ($form->getErrors() as $error) {
                $localErrors[] = $this->buildErrorArray($error);
            }
        } else {
            foreach ($form->getIterator() as $key => $child) {
                foreach ($child->getErrors() as $error) {
                    if (!empty($this->serialize($child))) {
                        $localErrors[$key] = $this->buildErrorArray($error);
                    }
                }

                if (count($child->getIterator()) > 0 && ($child instanceof Form)) {
                    if (!empty($this->serialize($child))) {
                        $localErrors[$key] = $this->serialize($child);
                    }
                }
            }
        }

        return $localErrors;
    }

    /**
     * @param $errors
     * @return array
     */
    private function createErrorMap($errors): array
    {
        $flattenedErrors = $this->arrayFlatten($errors, '.');
        $errorMap = [];
        $i = 0;

        foreach ($flattenedErrors as $index => $errorString) {
            if (substr($index, -12) == 'propertyPath') {
                $path = rtrim(str_replace(['children', '[', ']', 'data'], '', $errorString), '.');
                $arrayPath = explode('.', $path);

                $errRef = $errors;

                foreach ($arrayPath as $key) {
                    $errRef = $errRef[$key];
                }

                $errorMap[$i]['path'] = $arrayPath;
                $errorMap[$i]['error'] = $errRef;
                $i++;
            }
        }

        return $errorMap;
    }

    /**
     * @param Form $form
     * @param array $errors
     */
    public function unserialize(Form $form, array $errors)
    {
        $errorMap = $this->createErrorMap($errors);

        foreach ($errorMap as $field) {
            $formError = $this->createNewFormError($form, $field['error'], end($field['path']));
            $this->mapper->mapViolation($formError->getCause(), $form);
        }
    }

    /**
     * @param FormError $errorIn
     * @return string
     */
    private function buildErrorArray(FormError $errorIn): string
    {
//        $errorOut = [];
//
//        $errorOut['message'] = $errorIn->getMessage();
//        $errorOut['messageTemplate'] = $errorIn->getMessageTemplate();
//        $errorOut['messagePluralization'] = $errorIn->getMessagePluralization();
//        $errorOut['messageParameters'] = $errorIn->getMessageParameters();

        return $errorIn->getMessage();
    }

    /**
     * @param Form $form
     * @param      $error
     * @param      $field
     *
     * @return FormError
     */
    private function createNewFormError(Form $form, $error, $field): FormError
    {
        if (isset($error['cause']['cause'])) {
            $error['cause']['propertyPath'] =
                $error['cause']['cause']['propertyPath'] ?? 'children[' . $field . '].data';
            $error['cause']['invalidValue'] = $error['cause']['cause']['invalidValue'] ?? null;
            $error['cause']['plural'] = $error['cause']['cause']['plural'] ?? null;
            $error['cause']['code'] = $error['cause']['cause']['code'] ?? null;
            $error['cause']['constraint'] = $error['cause']['cause']['constraint'] ?? null;
        }

        $constraint = null;

        if (isset($error['cause']['constraint'])) {
            $constraint = unserialize($error['cause']['constraint']);
        }

        return new FormError(
            $error['message'],
            $error['messageTemplate'] ?? null,
            $error['messageParameters'] ?? [],
            $error['messagePluralization'] ?? null,
            new ConstraintViolation(
                $error['cause']['message'],
                $error['cause']['messageTemplate'],
                $error['cause']['parameters'],
                $form,
                $error['cause']['propertyPath'] ?? $field . '.data',
                $error['cause']['invalidValue'] ?? '',
                $error['cause']['plural'] ?? null,
                $error['cause']['code'] ?? null,
                $constraint,
                $error['cause']['cause'] ?? null
            )
        );
    }

    /**
     * @param array $array
     * @param string $separator
     * @param string $flattenedKey
     * @return array
     */
    private function arrayFlatten(array $array, string $separator = '_', string $flattenedKey = ''): array
    {
        $flattenedArray = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $flattenedArray = array_merge(
                    $flattenedArray,
                    $this->arrayFlatten(
                        $value,
                        $separator,
                        (
                        strlen($flattenedKey) > 0 ? $flattenedKey . $separator : ""
                        ) . $key
                    )
                );
            } else {
                $flattenedArray[(strlen($flattenedKey) > 0 ? $flattenedKey . $separator : "") . $key] = $value;
            }
        }

        return $flattenedArray;
    }
}