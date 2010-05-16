<table>
	<thead>
		<tr class="title">
		{foreach item=item from=$titulo}
		    <td>{$item}</td>
		{/foreach}
		</tr>
	</thead>
	<tbody>
		{foreach item=item from=$values}
			<tr>
			{foreach item=col from=$item}
				<td>{$col}</td>
			{/foreach}
			</tr>
		{foreachelse}
			<tr><td colspan="{sizeof item=$titulo}">Nenhum Registro Encontrado</td></tr>
	    {/foreach}
	</tbody>
</table>