<?php

namespace App\Learning\Validator;

/**
 * 原生校验器
 * 同 Laravel的用法差不多
 * 目前只支持 `required`, `numeric`
 *
 * Class Validator
 * @package App\Learning\Validator
 */
class Validator
{
    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @var array
     */
    protected array $message = [];

    /**
     * @param $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * validate param
     * @param $data
     * @return array
     */
    public function validate($data)
    {
        $errors = [];

        foreach ($this->rules as $field => $rule) {
            // 执行验证规则
            if (!$this->validateField($field, $data, $rule)) {
                // 获取对应的错误消息
                $messageField = $field . '.' . $rule;
                $message = isset($this->message[$messageField]) ? $this->message[$messageField] : "The field $field is invalid.";
                $errors[$messageField] = $message;
            }
        }

        return $errors;
    }

    /**
     * 返回 true 表示验证通过，返回 false 表示验证失败
     * @param $field
     * @param $data
     * @param $rule
     * @return bool
     */
    protected function validateField($field, $data, $rule)
    {
        // 按照规则名称拆分验证规则
        $rules = explode('|', $rule);

        foreach ($rules as $rule) {
            // 按照冒号拆分验证规则名称和参数
            $segments = explode(':', $rule);
            $ruleName = $segments[0];
            $params = isset($segments[1]) ? explode(',', $segments[1]) : [];

            // 根据验证规则名称调用相应的验证方法
            if (method_exists($this, $ruleName)) {
                $valid = call_user_func_array([$this, $ruleName], [$field, $data, $params]);
                if (!$valid) {
                    return false;
                }
            }
        }

        return true;
    }

    protected function required($field, $data, $params)
    {
        return isset($data[$field]) && !empty($data[$field]);
    }

    protected function numeric($field, $data, $params)
    {
        return isset($data[$field]) && is_numeric($data[$field]);
    }
}


/**********************
 ** 使用方法
 **********************/

$validator = new Validator();

$validator->setRules([
    'name' => 'required',
]);

$validator->setMessage([
    'name.required' => '名字不能为空.',
]);

$errors = $validator->validate($_POST);
if (!empty($errors)) {
    // 抛出异常 413
}
