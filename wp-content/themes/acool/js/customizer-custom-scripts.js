!function(o) {
	parseInt(clean_box_misc_links.WP_version) < 4 && (o(".preview-notice").prepend('<b>' + clean_box_misc_links.old_version_message + "</b>"), jQuery("#customize-info .btn-upgrade, .misc_links").click(function(o) {
		o.stopPropagation()
	})), o(".preview-notice").prepend('<span id="clean_box_upgrade"><a target="_blank" class="button btn-upgrade" href="' + clean_box_misc_links.upgrade_link + '">' + clean_box_misc_links.upgrade_text + "</a></span>"), jQuery("#customize-info .btn-upgrade, .misc_links").click(function(o) {
		o.stopPropagation()
	})
}(jQuery), function(o) {
	o.controlConstructor.radio = o.Control.extend({
		ready: function() {
			"clean_box_theme_options[color_scheme]" === this.id && this.setting.bind("change", function(n) {
				jQuery.each(clean_box_misc_links.color_list, function(e, i) {
					"light" == n ? (o(e).set(i.light), o.control(e).container.find(".color-picker-hex").data("data-default-color", i.light).wpColorPicker("defaultColor", i.light)) : "dark" == n && (o(e).set(i.dark), o.control(e).container.find(".color-picker-hex").data("data-default-color", i.dark).wpColorPicker("defaultColor", i.dark))
				})
			})
		}
	})
}(wp.customize);