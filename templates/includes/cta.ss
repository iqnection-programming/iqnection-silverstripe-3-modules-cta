<div style="display:inline-block" class="$Align">
	<% if $EmbedCode %>
		$EmbedCode.RAW
	<% else %>
		<a href="$Link.URL" $Link.TargetATT>$Image</a>
	<% end_if %>
</div>