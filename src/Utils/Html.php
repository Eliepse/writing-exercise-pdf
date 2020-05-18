<?php


namespace Eliepse\WritingGrid\Utils;


final class Html
{
	/**
	 * @param string $name
	 * @param array $data
	 *
	 * @return string
	 * @throws \ErrorException
	 * @noinspection PhpIncludeInspection
	 */
	static public function render(string $name, array $data = []): string
	{
		if (empty($name)) {
			throw new \ErrorException("The html view cannot be empty");
		}

		$path = Path::resources('html/' . $name . '.php');

		if (!file_exists($path)) {
			throw new \ErrorException("The html view '$name' does not exists.");
		}

		ob_start();
		extract($data);
		include $path;

		return ob_get_clean() ?: '';
	}
}