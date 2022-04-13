var opt_Sex = $("select[name='tbl_options_sex']");
var opt_Cat = $("select[name='tbl_options_cat']");
var opt_Brand = $("select[name='tbl_options_brand']");
var opt_Time = $("select[name='tbl_options_time']");
var tbl_view_btn = $("button[name='filter_btn']");
var tbl_add_btn = $("a[id='tbl_add_btn']");
opt_Sex.change(tbl_allow_btn);
opt_Cat.change(tbl_allow_btn);
opt_Brand.change(tbl_allow_btn);
opt_Time.change(tbl_allow_btn);

function tbl_allow_btn() {
   if (opt_Sex.val() >= 0 && opt_Cat.val() >= 1 && opt_Brand.val() >= 1 || opt_Time.val() >= 0) {
      tbl_view_btn.removeAttr("disabled");
      tbl_add_btn.removeClass("disabled")
   } else if (!tbl_view_btn.attr("disabled") && !tbl_add_btn.hasClass("disabled")) {
      tbl_view_btn.attr("disabled", "");
      tbl_add_btn.addClass("disabled")
   }
}

function toggleTheme() {
   $("nav").toggleClass("navbar-dark navbar-light");
   $("nav").toggleClass("bg-dark bg-light");
   $("body").toggleClass("bg-dark bg-light")
}

function toggleNavbar() {
   $("body").toggleClass("fixed-nav");
   $("nav").toggleClass("fixed-top static-top")
}

function usr_passID(id) {
   $("#eModalLabel span").text("#" + id);
   window.history.pushState("", "", "?mod=account&act=list&usrid=" + id)
}

function product_passParam(id, name, origin, material, description, size, shape, color, warranty, price, gender, brand, category, lwidth, lheight, bwidth, tlen) {
   if (!brand && !category) window.history.pushState("", "", "?mod=manage&act=products&itemid=" + id);
   else window.history.pushState("", "", "?mod=manage&act=products&brand=" + brand + "&category=" + category + "&itemid=" + id);
   $("#eModalLabel span").text("#" + id);
   $("form[name='form-product-edit'] select[name='product_edit_sex']").val(gender);
   $("form[name='form-product-edit'] select[name='product_edit_cat']").val(category);
   $("form[name='form-product-edit'] select[name='product_edit_brand']").val(brand);
   $("form[name='form-product-edit'] input[name='product_edit_name']").val(name);
   $("form[name='form-product-edit'] input[name='product_edit_origin']").val(origin);
   $("form[name='form-product-edit'] input[name='product_edit_material']").val(material);
   $("form[name='form-product-edit'] textarea[name='product_edit_descr']").val(description);
   $("form[name='form-product-edit'] input[name='product_edit_size']").val(size);
   $("form[name='form-product-edit'] input[name='product_edit_shape']").val(shape);
   $("form[name='form-product-edit'] input[name='product_edit_color']").val(color);
   $("form[name='form-product-edit'] input[name='product_edit_warranty']").val(warranty);
   $("form[name='form-product-edit'] input[name='product_edit_price']").val(price);
   $("form[name='form-product-edit'] input[name='product_edit_lwidth']").val(lwidth);
   $("form[name='form-product-edit'] input[name='product_edit_lheight']").val(lheight);
   $("form[name='form-product-edit'] input[name='product_edit_bwidth']").val(bwidth);
   $("form[name='form-product-edit'] input[name='product_edit_tlen']").val(tlen)
}
function cl_passParam(id, name, price, descr, ibqty, type, manf, img1, img2, brand)
{
   window.history.pushState("", "", "?mod=manage&act=clense&itemid=" + id);
   $("#eModalLabel span").text("#" + id);
   $("form[name='form-product-edit'] input[name='cl_edit_name']").val(name);
   $("form[name='form-product-edit'] input[name='cl_edit_price']").val(price);
   $("form[name='form-product-edit'] textarea[name='cl_edit_descr']").val(descr);
   $("form[name='form-product-edit'] input[name='cl_edit_ibqty']").val(ibqty);
   $("form[name='form-product-edit'] input[name='cl_edit_type']").val(type);
   $("form[name='form-product-edit'] input[name='cl_edit_manf']").val(manf);
   $("form[name='form-product-edit'] input[name='cl_edit_img1']").val(img1);
   $("form[name='form-product-edit'] input[name='cl_edit_img2']").val(img2);
   $("form[name='form-product-edit'] input[name='cl_edit_brand']").val(brand);
}
$("a[data-target='#product_add']").on("click", function () {
   window.history.pushState("", "", "?mod=manage&act=products&gender=" + opt_Sex.val() + "&category=" + opt_Cat.val() + "&brand=" + opt_Brand.val())
});
$("li[class='breadcrumb-item']:last-child").addClass("active");

function order_passParam(id, product, quantity, price, total_cost, notes) {
   $("#detail #eModalLabel span").html("#" + id);
   $("#detail td#_product").html(product);
   $("#detail td#_qty").html(quantity);
   $("#detail td#_price").html(price);
   $("#detail td#_total").html(total_cost);
   $("#detail td#_cnote").html(notes)
};

$(document).ready(function () {
   $('#form-pw-change').validate({
      rules: {
         pwc_pw_old: {
            required: true,
            minlength: 9
         },
         pwc_pw: {
            required: true,
            minlength: 9
         },
         pwc_pw_repeat: {
            required: true,
            minlength: 9
         }
      },
      messages: {
         pwc_pw_old: {
            required: 'Fill out this field',
            minlength: 'At least 9 characters'
         },
         pwc_pw: {
            required: 'Fill out this field',
            minlength: 'At least 9 characters'
         },
         pwc_pw_repeat: {
            required: 'Fill out this field',
            minlength: 'At least 9 characters'
         }
      },
      submitHandler: function (form) {
         form.submit();
      }
   });

   $('#form-create').validate({
      rules: {
         owner_create_mail: {
            required: true,
            maxlength: 30,
            email: true
         },
         owner_create_name: {
            required: true
         },
         owner_create_phone: {
            required: true
         }
      },
      messages: {
         owner_create_mail: {
            required: 'Fill out this field',
            maxlength: 'Max 30 characters',
            email: 'Enter a valid email address'
         },
         owner_create_name: {
            required: 'Fill out this field'
         },
         owner_create_phone: {
            required: 'Fill out this field'
         }
      },
      submitHandler: function (form) {
         form.submit();
      }
   });
});