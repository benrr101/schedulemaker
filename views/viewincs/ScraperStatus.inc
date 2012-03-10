<div class='subContainer'>
	<h2>Scraper Last Ran: <?= date("m/d/y h:ia", $params['lastScrape']) ?></h2>
	<h2>Last 20 Scrape Reports</h2>
	<table id='scraperStatus'>
		<tr class='separated'>
			<th>Scrape Started</th>
			<th>Scrape Finished</th>
			<th>Time Elapsed</th>
			<th>Courses Added</th>
			<th>Sections Added</th>
			<th>Sections Updated</th>
			<th>Failures</th>
		</tr>
		<?
		if(!count($params['logEntries'])) {
			// No reports here
			?><tr><td colspan='7'>No Logs Exist</td></tr><?
		} else {
			foreach($params['logEntries'] as $log) { ?>
				<tr>
					<td><?= date('m/d/y h:ia', $log['timeStarted']) ?></td>
					<td><?= date('m/d/y h:ia', $log['timeEnded']) ?></td>
					<td><?= date("G:i:s", ($log['timeEnded'] - $log['timeStarted'])) ?></td>
					<td><?= $log['coursesAdded'] ?></td>
					<td><?= $log['sectionsAdded'] ?></td>
					<td><?= $log['sectionsUpdated'] ?></td>
					<? if($log['failures'] > 0) { ?>
						<td class='failures'><?= $log['failures'] ?></td>
					<? } else { ?>
						<td>0</td>
					<? } ?>
				</tr>
			<? }
		} ?>
	</table>
</div>
