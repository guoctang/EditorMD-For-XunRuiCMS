<?php namespace My\Field\Editor_md; // demo是插件目录

class Editor_md extends \Phpcmf\Library\A_Field {

    /**
     * 构造函数
     */
    public function __construct(...$params) {
        parent::__construct(...$params);
        $this->fieldtype = TRUE;
        $this->defaulttype = 'TEXT'; // 默认显示的类型
    }

    /**
     * 字段相关属性参数
     */
    public function option($option) {
        return [
            $this->field_type($option['fieldtype'], $option['fieldlength']),
            ''
        ];
    }


    /**
     * 字段显示
     */
    public function show($field, $value = null) {
        $html = '
        <div class="portlet  bordered light">
        <div class="portlet-body">
        <div class="gctscroller" style="width:100%" data-always-visible="1" data-rail-visible="1">
        '.nl2br(htmlentities($value)).'                
        </div>
        </div>
        </div>';
        return $this->input_format($field['fieldname'], $field['name'], $html);
    }

    /**
     * 字段表单输入
     */
    public function input($field, $value = '') {

        // 字段禁止修改时就返回显示字符串
        if ($this->_not_edit($field, $value)) {
            return $this->show($field, $value);
        }

        // 字段存储名称
        $name = $field['fieldname'];

        // 字段显示名称
        $text = ($field['setting']['validate']['required'] ? '<span class="required" aria-required="true"> * </span>' : '').dr_lang($field['name']);


        // 表单附加参数
        $attr = $field['setting']['validate']['formattr'];

        // 字段提示信息
        $tips = $field['setting']['validate']['tips'] ? '<span class="help-block" id="dr_'.$field['fieldname'].'_tips">'.$field['setting']['validate']['tips'].'</span>' : '';

        // 表单高度设置
        $height = $field['setting']['option']['height'] ? $field['setting']['option']['height'] : '100';

        // 字段默认值
        $value = strlen($value) ? $value : $this->get_default_value($field['setting']['option']['value']);

        $str = '
<link rel="stylesheet" href="../static/EditorMD/css/editormd.css" />
<div id="test-editor">
    <textarea style="display:none;" name="data['.$name.']" >'.$value.'</textarea>
</div>
<script src="../static/EditorMD/editormd.min.js"></script>
<script type="text/javascript">
    $(function() {
        var editor = editormd("test-editor", {
             width  : "100%",
             height : "'. $height .'",
            path   : "../static/EditorMD/lib/"
        });
    });
</script>
';
        return $this->input_format($name, $text, $str.$tips);
    }

}