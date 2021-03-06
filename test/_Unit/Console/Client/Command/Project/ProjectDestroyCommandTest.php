<?php

namespace Kraken\_Unit\Console\Client\Command\Project;

use Kraken\_Unit\Console\Client\_T\TCommand;
use Kraken\Console\Client\Command\Project\ProjectDestroyCommand;
use Kraken\Runtime\Runtime;
use Symfony\Component\Console\Input\InputOption;

class ProjectDestroyCommandTest extends TCommand
{
    /**
     * @var string
     */
    protected $class = ProjectDestroyCommand::class;

    /**
     *
     */
    public function testApiConfig_ConfiguresCommand()
    {
        $command = $this->createCommand();

        $args = [];

        $opts = [];
        $opts[] = [ 'flags', null, InputOption::VALUE_OPTIONAL, '#^(.*?)$#', Runtime::DESTROY_FORCE_SOFT ];

        $this->assertCommand($command, 'project:destroy', '#^(.*?)$#si', $args, $opts);
    }

    /**
     *
     */
    public function testApiCommand_ReturnsCommandData()
    {
        $command  = $this->createCommand([ 'informServer', 'validateDestroyFlags' ]);
        $command
            ->expects($this->once())
            ->method('validateDestroyFlags')
            ->will($this->returnArgument(0));
        $command
            ->expects($this->once())
            ->method('informServer')
            ->with(
                null,
                'project:destroy',
                [
                    'flags' => 'flags'
                ]
            );

        $input  = $this->createInputMock();
        $output = $this->createOutputMock();

        $this->callProtectedMethod($command, 'command', [ $input, $output ]);
    }
}
