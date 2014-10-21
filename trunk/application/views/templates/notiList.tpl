<ul>
{foreach from=$items item=item}
    {foreach from=$item item=foo}
	    <li>{$foo}</li>
	{/foreach}
{/foreach}
</ul>